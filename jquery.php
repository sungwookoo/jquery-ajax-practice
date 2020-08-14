<script>
$(document).ready(function(){
    get_list();
});
function get_list(){
    $.ajax({
        method : 'post',
        url : "controller.php",
        data : {type : "get_list"}
    }).done(function(data){
       var data= JSON.parse(data);
       console.log(data);
       var html;
       var tr_href="'/a.php'";
       for(var i=0; i<data.length;i++){
            html+="<tr id=\"item\"style=\"cursor:pointer; \" onClick=\"read();\" onMouseOver=\"this.style.backgroundColor='skyblue'\" onMouseOut=\"this.style.backgroundColor='white'\">";
            html +="<td>"+(i+1)+"</td>";
            html +="<td>"+data[i]['title']+"</td>";
            html +="<td>"+data[i]['content']+"</td>";
            html +="<td>"+data[i]['created_at']+"</td>";
            html+="</tr>";
       }
    
       $("#list").html(html);
       
    });
}
function save(){
    var title=$("#title").val();
    var content = $("#content").val();
    
    $.ajax({
        method : "post",
        url : "controller.php",
        data : {type : "save", title : title, content : content}
    }).done(function(data){
        get_list();
        
    $("#title").val('');
    $("#content").val('');
    
    });
}
function read(){
    $.ajax({
        method: "get",
        url: "controller.php",
        data: {type : "read"}
    }).done(function(data){
            console.log(data);
    });
}
</script>