<?php

$SERVER= "20.123.84.182"; //"127.0.0.1";
$USERNAME="root";
$PASSWRD="Pts9XeemVzy+";
$DATABASE="final_project";

$con=mysqli_connect($SERVER,$USERNAME,$PASSWRD, $DATABASE);

//check connection:
if ($con-> connect_error) {
    die ("Connection failed: ".$con-> connect_error);
}







