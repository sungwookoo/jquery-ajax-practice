<?php
class DB_helper
{
    private $connect;
    public $db_name='table';
    public $userid='root';
    public $password='qwer1234';
    public $host='localhost';
    function __construct()
    {
    }
    public function Connect()
    {
        $this->connect = mysqli_connect($this->host, $this->userid, $this->password, $this->db_name, '3306');

        if(!$this->connect){
            return '[연결실패] : '.$this->connect->connect_error.'';
        } else {
//            echo '[연결성공]';
        }
        @mysqli_select_db($this->connect, $this->db_name) or die('DB 선택 실패');
        mysqli_query($this->connect,' SET NAMES utf8');
        return true;
    }
    public function Disconnect()
    {
        mysqli_close($this->connect);
    }
    public function Select($query)
    {

        $result = mysqli_query($this->connect, $query);
        $i = 0;
        $return = array();
        if($result) {
            while ($row = $result->fetch_array()) {
                $return[$i] = $row;
                $i++;
            }
        }
        return $return;
    }
    
    public function Select_assoc($query)
    {

        $result = mysqli_query($this->connect, $query);
        $i = 0;
        $return = array();
        while ($row = $result->fetch_array()) {
            $return[$i] = $row;
            $i++;
        }
        
        return $return;
    }
    public function Update($query)
    {

        $result = mysqli_query($this->connect, $query);
        
        return $result;
    }
    public function Delete($query)
    {

        $result = mysqli_query($this->connect, $query);
        
        return $result;
    }
    public function Insert($query)
    {
//        $this->connect = mysqli_connect($this->host, $this->userid, $this->password, $this->dbname, '3306');
//        if(!$this->connect){
//            return '[연결실패] : '.$this->connect->connect_error.'';
//        }
//        @mysqli_select_db($this->connect, $this->db_name) or die('DB 선택 실패');
//        print_r($query);
//        mysqli_query($this->db_name,' SET NAMES utf8');
        $result = mysqli_query($this->connect, $query);
        $result = mysqli_query($this->connect, 'SELECT LAST_INSERT_ID();');
        $result = mysqli_fetch_array($result);
//        mysqli_close($this->connect);
        return $result[0];
    }
    
  
    public function StartTransaction()
    {
        return $result = mysqli_query($this->connect, "START TRANSACTION;");
    }
    
    public function Commit()
    {
        return $result = mysqli_query($this->connect, "COMMIT;");
    }
    public function Rollback()
    {
        return $result = mysqli_query($this->connect, "ROLLBACK;");
    }


}