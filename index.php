
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php 
include "jquery.php";
?>
<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="/jquery-ajax-practice/css/bootstrap.css">
        <style>
            .title_of{
                width: 370px;
                overflow: hidden;
                text-overflow: ellipsis;  /* ...처리 */
                white-space: nowrap;
            }
            .writer_of{
                width: 120px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

        </style>
    </head>
<body>
    <div style="width:53%; float:left;">
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
            <input class="form-control" style="width:150px; float:right; margin-top:30px; margin-bottom:10px;" type="button" id="close_btn" value="새 게시글 작성" onclick="init_board();">
           
            
        </table>
        
    </div>
    
    <div id="write_area" style="width:45%; float:right;">
            
        <table>
            <tr>
                <input type="hidden" id="id">
                <td><input class="form-control" style="width:600px; margin-top:50px;" type="text" id="writer" placeholder="작성자 (필수)"></td>
            </tr>
            <tr>
                <td><input class="form-control" type="text" id="title" placeholder="제목 (필수)"></td>
            </tr>
            <tr>
                <td><textarea class="form-control" id="content" cols="30" rows="20" placeholder="내용 (필수)"></textarea></td>
            </tr>
            <tr>
                <td><input class="form-control" type="button" id="save_modify_btn" value="글쓰기"></td>
            </tr>
            <tr>
                <td><input class="form-control" type="button" style="display:none" id="delete_btn" value="삭제" onclick="delete_board();"></td>
            </tr>
            <tr>
                <td><input class="form-control" type="button" id="cancle_btn" value="취소" onclick="hide_writeArea();"></td>
            </tr>
        </table>
    </div>
</body>
</html>