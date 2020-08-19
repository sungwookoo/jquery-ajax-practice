<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php 
include "jquery.php";
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="/jquery-ajax-practice/css/bootstrap.css">
    <style>
    .title_of {
        width: 370px;
        overflow: hidden;
        text-overflow: ellipsis;
        /* ...처리 */
        white-space: nowrap;
    }

    .writer_of {
        width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    </style>
</head>

<body>
    <a href="" onclick="get_list();"><h1>게시판</h1></a>
    <div id="list_area" style="width:50%; float:left;">
        <div id="search">
            <table>
                <tr>
                    <td><select class="custom-select" style="text-align:center;font-size:13px;width:80px;height:30px;"
                            id="search_category">
                            <option value="title">제목</option>
                            <option value="date">날짜</option>
                            <option value="writer">작성자</option>
                        </select></td>
                    <td><input class="form-control" style="width:500px;height:30px;" type="text" id="search_input"
                            autofocus></td>
                    <td><input class="form-control" type="button" style="font-size:13px;width:60px;height:30px;"
                            id="search_btn" value="검색" onclick="search();"></td>
                </tr>
            </table>
        </div>
        <table class="table">
            <thead style="text-align:center">
                <tr>
                    <td style="width:60px;">번호</td>
                    <td style="width:370px;">제목</td>
                    <td style="width:120px;">작성자</td>
                    <td>작성일자</td>
                    <td>수정일자</td>
                </tr>
            </thead>
            <tbody id="list">
            </tbody>
            <input class="form-control" style="width:150px; float:right; margin-top:30px; margin-bottom:10px;"
                type="button" id="close_btn" value="새 게시글 작성" onclick="init_board();">


        </table>

    </div>

    <div id="write_area" style="width:45%; float:right;">

        <table>
            <tr>
                <td><label style="font-size:12px; margin-top:50px;">작성자</label></td>
            </tr>
            <tr>
                <input type="hidden" id="id">
                <td><input class="form-control" style="width:600px;" type="text" id="writer" placeholder="작성자"></td>
            </tr>
            <tr>
                <td><label style="font-size:12px; margin-top:10px;">제목</label></td>
            </tr>
            <tr>
                <td><input class="form-control" type="text" id="title" placeholder="제목"></td>
            </tr>
            <tr>
                <td><label style="font-size:12px; margin-top:10px;">내용</label></td>
            </tr>
            <tr>
                <td><textarea class="form-control" id="content" cols="30" rows="20" placeholder="내용"></textarea></td>
            </tr>
            <tr>
                <td><input class="form-control" type="button" style="width:100px;" id="save_modify_btn" value=""></td>
            </tr>
            <tr>
                <td><input class="form-control" type="button" style="width:100px; display:none;" id="delete_btn"
                        value="삭제" onclick="if(!confirm('삭제하시겠습니까?'))return;else delete_board();"></td>
            </tr>
            <tr>
                <td><input class="form-control" type="button" style="width:100px;" id="cancle_btn" value="닫기"
                        onclick="hide_writeArea();"></td>
            </tr>
        </table>
    </div>
</body>

</html>