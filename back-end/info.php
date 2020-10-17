<?php
/**
 * Created by PhpStorm.
 * User: Muntari
 * Date: 10/17/2020
 * Time: 10:33 AM
 */

include '/model/Users.php';
$userAgent =  $_SERVER['HTTP_USER_AGENT'];

$users = new Users();
$errCode = 0;
$errMessage = "";
$name = isset($_COOKIE["username"]) ? $_COOKIE["username"] : "";
$password = isset($_COOKIE["password"]) ? $_COOKIE["password"] : "";
if ($errCode == 0) {
    if (strlen($name) == 0) {
        $errCode = 1;
        $errMessage = "Username tidak boleh kosong";
    }
}
if ($errCode == 0) {
    if (strlen($name) > 50) {
        $errCode = 1;
        $errMessage = "Username tidak boleh melebihi 50 karakter";
    }
}
if ($errCode == 0) {
    if (strlen($password) == 0) {
        $errCode = 1;
        $errMessage = "Passwrod tidak boleh kosong";
    }
}
if ($errCode == 0) {
    if (strlen($password) > 8) {
        $errCode = 1;
        $errMessage = "Passwrod tidak boleh melebihi 8 karakter";
    }
}
$data=[];
if ($errCode == 0) {
    try {
        $data = $users->get($name, $password, $userAgent);
        if(count($data)> 0){
            setcookie("username", $name , time() + (86400 * 30), "/");
            setcookie("password", $password, time() + (86400 * 30), "/");
        }else{
            $errCode = 1;
            $errMessage = "Anda Belum Login";
            setcookie("username", $name , time() - (86400 * 30), "/");
            setcookie("password", $password, time() - (86400 * 30), "/");
        }
    } catch (Exception $ex) {
        $errCode = 1;
        $errMessage = $ex->getMessage();
    }
}
$options = [];
$options["errCode"] = $errCode;
$options["errMessage"] = $errMessage;
$options["data"] = $data;
echo json_encode($options);
