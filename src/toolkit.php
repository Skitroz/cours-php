<?php
function dd( ...$params)
{
    foreach ($params as $param) {
        echo "<pre>";
        var_dump($param);
        echo "</pre>";
    }
    return;

}
function ddd( ...$params)
{
    echo "<pre>";
    var_dump($params);
    echo "</pre>";
        die();
}

function debugMode($active)
{
    if($active){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
 
    }
    return;
}

function fromInc($name){
    if(file_exists("./templates/includes/". $name . ".inc.php")){
        include "./templates/includes/". $name . ".inc.php";
    }else{
        return false;
    }
}

function getAll($table, $id){
    global $connection;
    $statement = $connection->query("SELECT * FROM $table WHERE $id");
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    dd($data);
}

function getId($table, $name, $surname){
    global $connection;
    $statement = $connection->prepare("SELECT * FROM $table WHERE `name` = :name AND `surname` = :surname");
    $statement->bindParam(':name', $name);
    $statement->bindParam(':surname', $surname);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    dd($data);
}

function create($table, $name, $surname){
    global $connection;
    $statement = $connection->prepare("INSERT INTO $table (`name`, `surname`, `status`) VALUES (:name, :surname, 'online') ");
    $statement->bindParam(':name', $name);
    $statement->bindParam(":surname", $surname);
    $statement->execute();
}

function delete($table, $id){
    global $connection;
    $statement = $connection->prepare("DELETE FROM $table WHERE id = ?");
    $statement->bindParam(1, $id);
    $statement->execute();
}

function update($table, $id, $status){
    global $connection;
    $statement = $connection->prepare("UPDATE $table SET `status` = ? WHERE id = ?");
    $statement->bindParam(1, $status);
    $statement->bindParam(2, $id);
    $statement->execute();
}