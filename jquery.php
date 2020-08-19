<script>
var modify_cnt= 0;
$(document).ready(function() {
    
    $("#write_area").hide();
    get_list();
    $("#list").on('click', 'tr', function() {
        $(this).css("background", "#00FFFF");
        $(this).siblings().css("background", "#fff");
        
        $("#cur_title").attr('id','');
        $("#cur_writer").attr('id','');
        $("#cur_updated_at").attr('id','');
        $(this).children('td').eq(1).attr('id','cur_title');
        $(this).children('td').eq(2).attr('id','cur_writer');
        $(this).children('td').eq(4).attr('id','cur_updated_at');

        var id = $(this).children('input').val();
        get_board(id);

        $("#save_modify_btn").val("수정");
        $("#delete_btn").show();
    });
    $("#save_modify_btn").on('click', function() {
        if ($(this).val() == '수정') {
            ++modify_cnt;
            unset_ro();
            $("#delete_btn").hide();
            $("#list_area").hide();
            $("#write_area").css({"width":"65%","clear":"right ","margin":"0 auto"});
            
            if(modify_cnt==2){
            console.log(modify_cnt);
            modify();
            hide_writeArea();
            modify_cnt=0;
            set_ro();
            }
        } else {
            save();
        }
    });
    //엔터누르면 검색버튼클릭
        //엔터누르면 검색버튼클릭
    $("#search_input").keypress(function(event){
        if(event.which==13){
            $('#search_btn').click();
            return false;
        }
    });

    //검색 카테고리로 날짜 선택 시 달력 표시
    $("#search_category").on("change",function(){
        var category=$(this).val();
        console.log(category);
        if(category=='date'){
            $("#search_input").attr('type','date');
        }
        else{
            $("#search_input").attr('type','text');
        }
    })

    if(modify_cnt==0){
        set_ro();
    }

    
}); // document ready 끝
function search(){
    get_list();
}
function get_list(a='') {
    var search_category=$("#search_category").val();
    var search_input=$("#search_input").val();

    $.ajax({
        method: 'post',
        url: "controller.php",
        data: {
            type: "get_list", search_category:search_category, search_input:search_input
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
        // 게시글 작성 후 get_board
        $("#list").html(html);
        if(a=="save"){
            $("#list tr").eq(0).css("background", "#00FFFF");
            $("#save_modify_btn").val("수정");
            $("#delete_btn").show();
            var id = $("#tr_k").children('input').val();
            get_board(id);
        }
        
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
        set_ro();
        $("#list_area").show();
        $("#write_area").css({"width":"45%","float":"right "});
        get_list("save");
        
        
       
        // hide_writeArea();
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
    var updated_at = getTimeStamp();
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
            content: content,
            updated_at: updated_at
        }
    }).done(function(data) {
        // get_list("modify");
        $("#cur_title").text(title);
        $("#cur_writer").text(writer);
        $("#cur_updated_at").text(updated_at);
    });
}

function init_board() {
    ++modify_cnt;
    unset_ro();
    //리스트 사라지고 우측화면이 가운데로
    $("#list_area").hide();
    $("#write_area").css({"width":"65%","clear":"right ","margin":"0 auto"});

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
//삭제
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
        get_list("delete");
        $("#write_area").hide();
    });
}
/*    기타 함수     */

// 우측 작성창 hide
function hide_writeArea() {
    set_ro();
    $("#write_area").css({"width":"45%"});
    $("#write_area").hide();
    $("#list_area").show();
    modify_cnt=0;
}

//현재 시간 YYYY-MM-DD HH:MM:SS 형태로 반환 (getTimestamp, leadingZeros)
function getTimeStamp() {
  var d = new Date();
  var s =
    leadingZeros(d.getFullYear(), 4) + '-' +
    leadingZeros(d.getMonth() + 1, 2) + '-' +
    leadingZeros(d.getDate(), 2) + ' ' +

    leadingZeros(d.getHours(), 2) + ':' +
    leadingZeros(d.getMinutes(), 2) + ':' +
    leadingZeros(d.getSeconds(), 2);

  return s;
}

function leadingZeros(n, digits) {
  var zero = '';
  n = n.toString();

  if (n.length < digits) {
    for (i = 0; i < digits - n.length; i++)
      zero += '0';
  }
  return zero + n;
}

function set_ro(){
    $("#writer").attr('readonly',true);
    $("#title").attr('readonly',true);
    $("#content").attr('readonly',true);
}

function unset_ro(){
    $("#writer").removeAttr('readonly');
    $("#title").removeAttr('readonly');
    $("#content").removeAttr('readonly');
}



</script>