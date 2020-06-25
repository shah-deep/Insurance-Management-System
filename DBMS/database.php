<?php

//Params to connect to a database
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "l5";

//Connection to database
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Database connection failed");
}
