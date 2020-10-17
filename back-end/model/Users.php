<?php
/**
 * Created by PhpStorm.
 * User: Muntari
 * Date: 10/17/2020
 * Time: 10:27 AM
 */

include  "/config/database.php";
class Users {
    var $table = "users";
    var $connect = null;

    function __construct(){
        $db = new Database();
        $this->connect = $db->connect();
    }

    function get($name= null, $password= null, $userAgent =null){
        $sql = "select * from ".$this->table." where 1=1 ";
        if(strlen($name)> 0 ){
            $sql .= " and username = '$name'";
        }
        if(strlen($password)> 0 ){
            $sql .= " and password = '$password'";
        }
        if(strlen($userAgent)> 0 ){
            $sql .= " and user_agent = '$userAgent'";
        }
        $data = mysqli_query($this->connect, $sql);
        $hasil = [];
        while($row = mysqli_fetch_array($data)){
            $hasil[] = $row;
        }
        return $hasil;
    }


    function save($name= null, $password= null){
        $data = mysqli_query($this->connect,"insert into ".$this->table." (username, password) VALUES ('$name', '$password')");
        return $data;
    }


    function update($name= null, $userAgent){
        $sql = "update ".$this->table." set status = 1, last_login = now(), user_agent = '$userAgent' where 1=1";
        if(strlen($name)> 0 ){
            $sql .= " and username = '$name'";
        }
        $data = mysqli_query($this->connect,$sql);
        return $data;
    }
}
