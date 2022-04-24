<?php

function ChangePassword($data)
{
    $bd = connection();
    $encodepass = md5($data->currentpassword);
    $newencodepass = md5($data->newpassword);
    $sentencia1 = $bd->prepare("SELECT * FROM usuarios WHERE passw = ? and id = ?");
    $sentencia1->execute([$encodepass, $data->id]);
    if($sentencia1->rowCount() > 0)
    {
        $sentencia2 = $bd->prepare("UPDATE usuarios SET passw = ? WHERE id = ?");
        $sentencia2->execute([$newencodepass, $data->id]);
        return true;
    }
    else
    {
        return false;
    }
}

function UpdateUser($data)
{
    $bd = connection();
    $sentencia = $bd->prepare("UPDATE usuarios SET names = ?, lastnames = ? where id = ?");
    $response = $sentencia->execute([$data->names, $data->lastnames, $data->id]);
    return $response;
}

function CreateUser($data)
{
    $bd = connection();
    $encodepass = md5($data->password);
    $sentencia = $bd->prepare("INSERT INTO usuarios(names, lastnames, passw, email, rol) VALUES (?, ?, ?, ?, ?)");
    $response = $sentencia->execute([$data->names, $data->lastnames, $encodepass, $data->email, $data->role]);
    return $response;
}

function GetAll()
{
    $bd = connection();
    $sentencia = $bd->query("SELECT * FROM usuarios");
    return $sentencia->fetchAll();
}

function GetUser($data)
{
    $bd = connection();
    $sentencia = $bd->prepare("SELECT * FROM usuarios where email = ? or id = ?");
    $sentencia->execute([$data->email, $data->id]);
    return $sentencia->fetchObject();
}

function Login($data)
{
    $bd = connection();
    $encodepass = md5($data->password);
    $sentencia = $bd->prepare("SELECT * FROM usuarios WHERE email = ? AND passw = ?");
    $sentencia->execute([$data->email, $encodepass]);
    return $sentencia->fetchObject();
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