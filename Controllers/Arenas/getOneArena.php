<?php
include_once "../../cors.php";
include_once "../../Models/modelArena.php";
$data = json_decode(file_get_contents("php://input"));
$get = GetArena($data);
echo json_encode($get);