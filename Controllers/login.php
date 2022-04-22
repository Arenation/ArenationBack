<?php
include_once "../cors.php";
include_once "../Models/modelLogin.php";
$data = json_decode(file_get_contents("php://input"));
$login = Login($data);
echo json_encode($login);