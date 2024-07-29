<?php
//query
function query(string $query, array $data =[])
{
    
    $string= "mysql:hostname=".DBHOST.";dbname=". DBNAME;
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

function query_row(string $query, array $data =[])
{
    
    $string= "mysql:hostname=".DBHOST.";dbname=". DBNAME;
    $con = new PDO($string, DBUSER ,DBPASS);

    $stm=$con-> prepare ($query);
    $stm->execute($data);

    $result=$stm->fetchAll(PDO::FETCH_ASSOC);
    if(is_array($result) && !empty($result))
    {
        return $result[0];
    }else
    return false;
}

//redirect

function get_pagination_vars(){
    //pagination
$page_number = $_GET['page' ]?? 1;
$page_number = empty($page_number) ? 1 : (int)$page_number;
$page_number = $page_number < 1 ? 1 : $page_number;

$current_link = $_GET['url'] ?? 'home'; 
$current_link = ROOT ."/".$current_link;
$query_string="";

foreach($_GET as $key => $value){
    if ($key != "url")
    $current_link .= "&".$key."=".$value;
}
if(!strstr($query_string,"page=")){
    $query_string .="&page=" .$page_number;
}
$query_string = trim($query_string,"&");
$current_link .="?".$query_string;

$current_link = preg_replace("/page=.*/", "page=".$page_number, $current_link);
$next_link    = preg_replace("/page=.*/", "page=".($page_number+1), $current_link);
$first_link   = preg_replace("/page=.*/", "page=1", $current_link);
$prev_page_number = $page_number < 2 ? 1 : $page_number - 1;
$prev_link    = preg_replace("/page=.*/", "page=".$prev_page_number, $current_link);

$result=[
    'current_link' =>  $current_link,
    'next_link'    =>  $next_link,
    'first_link'   =>  $first_link ,
    'prev_link'    =>  $first_link ,
    'page_number'  => $page_number,
];

return $result;
}

function redirect($page){
    header('Location:'.ROOT.'/'.$page);
    die;
}

//placeholder values
function old_value($key, $default =''){
    if(!empty($_POST[$key]))
    return $_POST [$key];

    return $default;
}

//imagefunction

function get_image($file)
{
    $file= $file ?? '';
    if(file_exists($file)){
        return ROOT.'/'.$file;
    }
    return ROOT.'/assets/images/no_image.jpg';
}
//string to url

function str_to_url($url)
{

   $url = str_replace("'", "", $url);
   $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
   $url = trim($url, "-");
   $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
   $url = strtolower($url);
   $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
   
   return $url;
}

//username clean

function esc($str)
{
    return htmlspecialchars($str ?? '');
}
//auth
function authenticate($row){
    $_SESSION['USER']= $row;
}

//check logged in
function logged_in(){
    if(!empty($_SESSION['USER']));
        return true;
        
    return false;

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
