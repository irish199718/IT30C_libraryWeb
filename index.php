<?php
session_start();
require_once "db.php";

$error = "";

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];