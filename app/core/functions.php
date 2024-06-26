<?php
//query
function query(string $query, array $data =[])
{
    
    $string="mysql:hostname=localhost;";
    $con = new PDO($string, DBUSER ,DBPASS);

    $stm=$con-> prepare ($query);
    $stm->execute($data);

    $result=$stm->fetchAll(PDO::FETCH_ASSOC);
    if(is_array($result) && !empty($result))
    {
        return $result;
    }else
    return false;
}

//redirect

function redirect($page){
    header('Location:'.$page);
    die;
}

//placeholder values
function old_value($key){
    if(!empty($_POST[$key]))
    return $_POST [$key];

    return "";
}

//create tables
create_tables();
 function create_tables (){


    $string="mysql:hostname=localhost;";
    $con = new PDO($string, DBUSER ,DBPASS);

    $query= "create database if not exists ". DBNAME;
    $stm=$con-> prepare ($query);
    $stm->execute();

    $query= "use ". DBNAME;
    $stm=$con-> prepare ($query);
    $stm->execute();
// user table
    $query= "create table if not exists users(

            id int primary key auto_increment,
            username varchar(50) not null,
            email varchar(100) not null,
            password varchar(255) not null,
            image varchar(1024) null,
            date datetime default current_timestamp,
            role varchar(10) not null,

            key username (username),
            key email (email)
        )";
    $stm = $con-> prepare ($query);
    $stm->execute();

// categories table
    $query= "create table if not exists categories(

            id int primary key auto_increment,
            category varchar(50) not null,
            slug varchar(100) not null,
            disabled tinyint default 0
        
        )";
    $stm=$con-> prepare ($query);
     $stm->execute();
            // posts table
     $query= "create table if not exists posts(
            id int,
            user_id int,
            category_id int,
            title varchar (100) not null,
            content text null,
            image varchar (1024) null,
            date datetime default current_timestamp,
            slug varchar(10) not null,
            
            key user_id (user_id),
            key category_id (category_id),
            key title (title),
            key date (date)
         )";
$stm=$con-> prepare ($query);
$stm->execute();

 }
