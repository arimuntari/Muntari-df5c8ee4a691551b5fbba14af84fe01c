<?php
/**
 * Created by PhpStorm.
 * User: Muntari
 * Date: 10/17/2020
 * Time: 11:34 AM
 */

include '/model/Users.php';
$userAgent =  $_SERVER['HTTP_USER_AGENT'];
$users = new Users();
$errCode = 0;
$errMessage = "";
$name = isset($_POST["username"]) ? $_POST["username"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
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

if ($errCode == 0) {
    try {
        $data = $users->get($name, $password);
        if(count($data)> 0){
            $users->update($name, $userAgent);
            setcookie("username", $name , time() + (86400 * 30), "/");
            setcookie("password", $password, time() + (86400 * 30), "/");
        }
    } catch (Exception $ex) {
        $errCode = 1;
        $errMessage = $ex->getMessage();
    }
}
$options = [];
$options["errCode"] = $errCode;
$options["errMessage"] = $errMessage;
$options["data"] = "";
echo json_encode($options);
