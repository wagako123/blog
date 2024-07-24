<?php

if (!logged_in()){
  redirect('login');
}

$section = $url [1] ?? 'dahsboard'; 
$action  = $url [2] ?? 'view'; 
$id      = $url [3] ?? 0; 



$filename = "../app/pages/admin/".$section.".php";

if(!file_exists($filename))
{
  $filename= "../app/pages/admin/404.php";
}

//add new form control
 
  if($action == 'add')
  {
    if(!empty($_POST))
    {

  //validate
  $errors=[];

  //errors

  if(empty($_POST['username'])){
    $errors['username']="username required";
  }else 
  if(!preg_match("/^[a-zA-Z1-9]+$/", $_POST['username'])){
    $errors['username'] = "username cannot have spaces";
  }

  $query = "select id from users where email = :email limit 1";
  $email = query($query, ['email'=>$_POST['email']]);
  
  if(empty($_POST['email'])){
    $errors['email']="email required";
  }else
  if($email){
    $errors['email']="email is already in use";
  }
  
  if(empty($_POST['password'])){
    $errors['password']="password required";
  }else
  if(strlen($_POST['password'])<8){
    $errors['password']="password must be 8 characters long";
  }if($_POST['password'] !== $_POST["retype_password"]){
    $errors['password']="passwords do not match";
  } 

  if (empty($errors)){
    //save to database
    $data=[];
    $data['username']= $_POST['username'];
    $data['email']   = $_POST['email'];
    $data['role']    = "user";
    $data['password']= password_hash($_POST['password'], PASSWORD_DEFAULT);


    $query=" insert into users(username,email,password,role) values(:username,:email,:password,:role)";
    query($query,$data);

    redirect('admin/users');
 }
}
  }
//EDIT SECTION
if($action == 'edit')
  {
   
        $query = "select * from users where id = :id limit 1";
        $row   = query_row($query, ['id' =>$id]);

        if(!empty($_POST))
        {

        if($row){

          //validate
          $errors=[];

          //errors

          if(empty($_POST['username'])){
            $errors['username']="username required";
          }else 
          if(!preg_match("/^[a-zA-Z1-9]+$/", $_POST['username'])){
            $errors['username'] = "username cannot have spaces";
          }

          $query = "select id from users where email = :email && id != :id limit 1";
          $email = query($query, ['email'=>$_POST['email'], 'id'=>$id ]);
          
          if(empty($_POST['email'])){
            $errors['email']="email required";
          }else
          if($email){
            $errors['email']="email is already in use";
          }
          
          if(empty($_POST['password'])){
            
          }else
          if(strlen($_POST['password'])<8){
            $errors['password']="password must be 8 characters long";
          }if($_POST['password'] !== $_POST["retype_password"]){
            $errors['password']="passwords do not match";
          } 

          if (empty($errors)){
            //save to database
            $data=[];
            $data['username']= $_POST['username'];
            $data['email']   = $_POST['email'];
            $data['role']    = $row['role'];
            $data['id']      = $id;

            if (empty($_POST['password'])){
              $query=" update users set username =:username, email =:email, role =:role where id= :id limit 1";

            }else {
            $data['password']= password_hash($_POST['password'], PASSWORD_DEFAULT);
            $query=" update users set username =:username, email =:email, password =:password, role =:role where id= :id limit 1";

            }

            query($query,$data);

            redirect('admin/users');
        }
        }
    }
  }


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    
    <title>Admin . My blog</title>

   

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="<?=ROOT?>/assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="<?=ROOT?>">Serene Stays</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="<?=ROOT?>/logout">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="<?=ROOT?>/admin">
              <i class="bi bi-speedometer"></i>
              Dashboard
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="<?=ROOT?>/admin/users">
              <i class="bi bi-person"></i>
              Users
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="<?=ROOT?>/admin/categories">
              <i class="bi bi-tags"></i>
              Categories
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="<?=ROOT?>/admin/posts">
              <i class="bi bi-chat-left-heart"></i>
              posts
            </a>
          </li>
          
        </ul>



        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Other</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="home">
              <i class="bi bi-house-door-fill"></i>
               home page
            </a>
          </li>
          
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <?php
       
        require_once $filename;
        ?>

    
    </main>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      

  </body>
</html>
