<script>
$(document).ready(function() {
    get_list();
    $("#write_area").hide();
    $("#list").on('click', 'tr', function() {
        $(this).css("background", "#00FFFF");
        $(this).siblings().css("background", "#fff");

        var id = $(this).children('input').val();
        get_board(id);

        $("#save_modify_btn").val("수정");
        $("#delete_btn").show();
    });
    $("#save_modify_btn").on('click', function() {
        if ($(this).val() == '수정') {
            modify();
        } else {
            save();
        }
    });
});

function get_list() {
    $.ajax({
        method: 'post',
        url: "controller.php",
        data: {
            type: "get_list"
        }
    }).done(function(data) {
        var data = JSON.parse(data);
        console.log(data);
        var html;
        var count = data.length;
        if (data.length != 0) {
            for (var i = 0; i < data.length; i++) {
                html += "<tr id='tr_k' style='cursor:pointer;'>";
                html += "<input type='hidden' value='" + data[i]['id'] + "'>";
                html += "<td style='text-align:right;'>" + (count - i) + "</td>";
                html += "<td><div class='title_of'>" + data[i]['title'] + "</div></td>";
                html += "<td><div class='writer_of'>" + data[i]['writer'] + "</div></td>";
                html += "<td style='text-align:center;'>" + data[i]['created_at'] + "</td>";
                if (data[i]['updated_at'] != null) html += "<td style='text-align:center;'>" + data[i][
                    'updated_at'
                ] + "</td>";
                else html += "<td style='text-align:center;'>-</td>";
                html += "</tr>";
            }
        } else {
            html = '';
        }

        $("#list").html(html);

    });
}

function save() {
    var writer = $("#writer").val();
    var title = $("#title").val();
    var content = $("#content").val();
    // 입력 필드 유효성 검사
    if (writer == "" || title == "" || content == "") {
        if (writer == "") {
            alert("작성자를 입력해주세요.");
            return $("#writer").focus();
        } else if (title == "") {
            alert("제목을 입력해주세요.");
            return $("#title").focus();
        } else if (content == "") {
            alert("내용을 입력해주세요.");
            return $("#content").focus();
        } else {
            alert("모든 필드에 입력이 필요합니다.");
            return;
        }
    }
    $.ajax({
        method: "post",
        url: "controller.php",
        data: {
            type: "save",
            writer: writer,
            title: title,
            content: content
        }
    }).done(function(data) {
        get_list();
        hide_writeArea();

        // 게시글 작성 후 get_board로
        /* 
        $("#tr_k").css("background", "#00FFFF");
        $("#tr_k").siblings().css("background", "#fff");
        $("#save_modify_btn").val("수정");
        $("#delete_btn").show();
        var id = $("#tr_k").children('input').val();
        get_board(id);
        console.log(id);
        */
    });
}

function get_board(id) {
    $.ajax({
        method: "post",
        url: "controller.php",
        data: {
            type: "get_board",
            id: id
        }
    }).done(function(data) {
        $("#write_area").show();
        data = JSON.parse(data);
        console.log(data);
        $("#writer").val(data[0]['writer']);
        $("#id").val(data[0]['id']);
        $("#title").val(data[0]['title']);
        $("#content").val(data[0]['content']);
        $("#created_at").val(data[0]['created_at']);
    });
}

function modify() {
    var id = $("#id").val();
    var writer = $("#writer").val();
    var title = $("#title").val();
    var content = $("#content").val();

    // 입력 필드 유효성 검사
    if (writer == "" || title == "" || content == "") {
        if (writer == "") {
            alert("작성자를 입력해주세요.");
            return $("#writer").focus();
        } else if (title == "") {
            alert("제목을 입력해주세요.");
            return $("#title").focus();
        } else if (content == "") {
            alert("내용을 입력해주세요.");
            return $("#content").focus();
        } else {
            alert("모든 필드에 입력이 필요합니다.");
            return;
        }
    }
    $.ajax({
        method: "post",
        url: "controller.php",
        data: {
            type: "modify",
            id: id,
            writer: writer,
            title: title,
            content: content
        }
    }).done(function(data) {
        get_list();
    });
}

function init_board() {
    $("#write_area").show();
    $("#delete_btn").hide();
    $("#save_modify_btn").val("작성");
    $("#list").children().css("background", "#fff");
    $.ajax({
        method: "post",
        url: "controller.php",
        data: {
            type: "init_board"
        }
    }).done(function(data) {
        $("#writer").val('');
        $("#title").val('');
        $("#content").val('');
    });

}

function delete_board() {
    var id = $("#id").val();
    $.ajax({
        method: "post",
        url: "controller.php",
        data: {
            type: "delete_board",
            id: id
        }
    }).done(function(data) {
        get_list();
        init_board();
        $("#write_area").hide();
    });
}

function hide_writeArea() {
    $("#write_area").hide();
}
</script>