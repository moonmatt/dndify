<?php
$dbServername = "databaseHost";
$dbUsername = "databaseUsername";
$dbPassword = "databasePassword";
$dbName = "databaseName";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);


// Code for the Database Table

// CREATE TABLE transactions (
//   id int(11) not null PRIMARY KEY AUTO_INCREMENT,
//   date date NOT NULL,
//   value decimal(10,2) NOT NULL,
//   type int(1) NOT NULL,
//   description varchar(70) NOT NULL
// )