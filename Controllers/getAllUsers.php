<?php
include_once "../cors.php";
include_once "../Models/modelLogin.php";
$users = GetAll();
echo json_encode($users);