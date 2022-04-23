<?php
include_once "../../cors.php";
include_once "../../Models/modelArena.php";
$users = GetAllArenas();
echo json_encode($users);