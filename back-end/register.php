<?php
/**
 * Created by PhpStorm.
 * User: Muntari
 * Date: 10/17/2020
 * Time: 10:49 AM
 */

include '/model/Users.php';
$users = new Users();
$errCode = 0;
$errMessage = "";
$name = isset($_POST["username"]) ? $_POST["username"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$confirmPassword = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : "";
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
    $checkName = $users->get($name);
    if ($checkName!=null) {
        $errCode = 1;
        $errMessage = "Username Sudah digunakan";
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
    if (strlen($confirmPassword) > 8) {
        $errCode = 1;
        $errMessage = "Konfirm Passwrod tidak boleh melebihi 8 karakter";
    }
}
if ($errCode == 0) {
    if ($confirmPassword != $password) {
        $errCode = 1;
        $errMessage = "Konfirm Passwrod dan password tidak sama";
    }
}

if ($errCode == 0) {
    try {
        $saved = $users->save($name, $password);
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

