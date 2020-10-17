<?php
/**
 * Created by PhpStorm.
 * User: Muntari
 * Date: 10/17/2020
 * Time: 10:09 AM
 */

class Database{

    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "db_testmkm";
    var $connect = null;

    function connect(){
        $connect = mysqli_connect($this->host, $this->username, $this->password,$this->database);
        return $connect;
    }
}

