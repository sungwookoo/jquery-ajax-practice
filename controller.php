<?php
date_default_timezone_set('Asia/Seoul');
include "include/DB_helper.php";
$type =$_REQUEST['type'];
$db = new DB_helper;
if($type=='get_list')
{
    $db->Connect();   
    $sql="select * from table.items";
    $list=$db->Select($sql);
    echo json_encode($list);
}
else if($type=="save")
{
    $db->Connect();
    $title=$_REQUEST['title'];
    $content=$_REQUEST['content'];
    $created_at=date('Y-m-d H:i:s');
    $sql="insert into table.items (title, content, created_at) values ('$title','$content','$created_at')";
    $db->Insert($sql);
}
else if($type=="read")
{
    $db->Connect();
    $title=$_REQUEST['title'];
    $content=$_REQUEST['content'];
}