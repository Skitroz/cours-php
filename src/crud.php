<?php 
require_once "./src/dbConnect.php";
require_once "./src/toolkit.php";

//fonction getAll
function getAll($table, $id){
    global $connection;
    $statement = $connection->query("SELECT * FROM $table WHERE $id");
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    dd($data);
}
// getAll("contacts", 1);

//fonction getById
function getId($table, $name, $surname){
    global $connection;
    $statement = $connection->prepare("SELECT * FROM $table WHERE `name` = :name AND `surname` = :surname");
    $statement->bindParam(':name', $name);
    $statement->bindParam(':surname', $surname);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    dd($data);
}
// getId("contacts", "Batelier", "Mathéo");

//fonction create
function create($table, $name, $surname){
    global $connection;
    $statement = $connection->prepare("INSERT INTO $table (`name`, `surname`, `status`) VALUES (:name, :surname, 'online') ");
    $statement->bindParam(':name', $name);
    $statement->bindParam(":surname", $surname);
    $statement->execute();
}
// create("contacts", "Couder", "Bastien");

//fonction delete
function delete($table, $id){
    global $connection;
    $statement = $connection->prepare("DELETE FROM $table WHERE id = ?");
    $statement->bindParam(1, $id);
    $statement->execute();
}
// delete("contacts", 13);

//fonction update
function update($table, $id, $status){
    global $connection;
    $statement = $connection->prepare("UPDATE $table SET `status` = ? WHERE id = ?");
    $statement->bindParam(1, $status);
    $statement->bindParam(2, $id);
    $statement->execute();
}
// update("contacts", 1, "online");