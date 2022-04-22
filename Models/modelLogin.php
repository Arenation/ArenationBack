<?php

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
    $sentencia = $bd->prepare("SELECT * FROM usuarios where email = ?");
    $sentencia->execute([$data->email]);
    if($sentencia->fetchObject() != false){
        return true;
    }else{
        return false;
    }
}

function Login($data)
{
    $bd = connection();
    $encodepass = md5($data->password);
    $sentencia = $bd->prepare("SELECT email, names, lastnames, rol FROM usuarios where email = ? and passw = ?");
    $sentencia->execute([$data->email, $encodepass]);
    return $sentencia->fetchObject();
}

function connection()
{
    $pass = "";
    $user = "root";
    $dbName = "validar";
    $database = new PDO('mysql:host=127.0.0.1;dbname=' . $dbName, $user, $pass);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}