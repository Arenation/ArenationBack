<?php

function GetArena($data)
{
    $bd = connection();
    $sentencia = $bd->prepare("SELECT * FROM arena where id = ?");
    $sentencia->execute([$data->id]);
    return $sentencia->fetchObject();
}

function GetAllArenas()
{
    $bd = connection();
    $sentencia = $bd->query("SELECT * FROM arena");
    return $sentencia->fetchAll();
}

function connection()
{
    $pass = "ce8ba12b90601ee125a4e41ccc55983fab6e4898f76948b5c5f957515e1f6d09";
    $user = "btrkioumjjkibb";
    $dbName = "d7jecr30ej3csa";
    $database = new PDO("pgsql:host=ec2-34-192-210-139.compute-1.amazonaws.com;dbname=". $dbName, $user, $pass);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}