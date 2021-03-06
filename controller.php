<?php
date_default_timezone_set('Asia/Seoul');
include "include/DB_helper.php";
$type =$_REQUEST['type'];
$db = new DB_helper;

if($type=="get_list")
{
    $search_category=$_REQUEST["search_category"];
    $search_input=$_REQUEST["search_input"];

    $db->Connect();   
    $sql="select * from table.items ";
    
    if($search_category != ''){
        if($search_input != ''){
            if($search_category=="date"){
                $sql.=" where created_at like '%$search_input%' ";
            } else{
                $sql.=" where $search_category like '%$search_input%' ";
            }
        }
    }
    $sql.=" order by id desc";
    $list=$db->Select($sql);
    echo json_encode($list);
    $db->Disconnect();
}
else if($type=="save")
{
    $db->Connect();
    $writer=$_REQUEST['writer'];
    $title=$_REQUEST['title'];
    $content=$_REQUEST['content'];
    $created_at=date('Y-m-d H:i:s');
    $sql="insert into table.items (writer, title, content, created_at) values ('$writer', '$title','$content','$created_at')";
    $db->Insert($sql);
    $db->Disconnect();
}
else if($type=="get_board")
{
    $id=$_REQUEST['id'];
    $db->Connect();
    $sql="select * from table.items where id='$id'";
    $list=$db->Select($sql);
    echo json_encode($list);
    $db->Disconnect();
}
else if($type=="modify")
{
    $db->Connect();
    $id=$_REQUEST['id'];
    $writer=$_REQUEST['writer'];
    $title=$_REQUEST['title'];
    $content=$_REQUEST['content'];
    // $updated_at=date('Y-m-d H:i:s');
    $updated_at=$_REQUEST['updated_at'];
    $sql="UPDATE table.items SET writer='$writer',title='$title',content='$content',updated_at='$updated_at' where id='$id'";
    $db->Update($sql);
    $db->Disconnect();
}
else if($type=="delete_board")
{
    $db->Connect();
    $id=$_REQUEST['id'];
    $sql="DELETE FROM table.items where id='$id'";
    $db->Delete($sql);
    $db->Disconnect();
}