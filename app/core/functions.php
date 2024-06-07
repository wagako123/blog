<?php

function create_tables (){


$string="mysql:hostname=localhost;";
$con = new PDO($string, DBUSER ,DBPASS);

$query= "create database if not exists".DBNAME;
$stm=$con-> prepare ($query);
$stm->execute();

$query= "create table if not exists users(

    id int primary key auto_incriment,
    user varchar (50) not null,
    email varchar (100) not null,
    password varchar(255) not null,
    image varchar (1024) null,
    date datetime default current_timestamp,
    role varchar(10) not null,

    key email (email),
    key username (username)
    )";
$stm=$con-> prepare ($query);
$stm->execute();

}
