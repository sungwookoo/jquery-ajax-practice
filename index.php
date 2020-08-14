<?php 
include "include.php"; 
include "jquery.php";
?>

<body>
    <div id="list_area" style="width:45%; float:left;">
        <table>
            <thead>
                <tr>
                    <td>번호</td>
                    <td>제목</td>
                    <td>내용</td>
                    <td>생성일</td>
                    <td>수정일</td>
                </tr>
            </thead>
            <tbody id="list">
            </tbody>
        </table>
    </div>
    <div id="write_area" style="width:45%; float:right;">
        <input type="text" id="title" value="" placeholder="제목">
        <input type="text" id="content" value="" placeholder="내용">
        <input type="hidden" id="id">
        <!-- <input type="text" id="created_at"" value=""> -->
        <!-- <input type="text" id="updated_at"" value=""> -->
        <input type="button" onclick="save();" value="작성">
    </div>
</body>