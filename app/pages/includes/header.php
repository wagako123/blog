<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    
    <title>Home ·<?= APP_NAME?> </title>


    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
    
    </style>

    
    <!-- Custom styles for this template -->
<link href="<?=ROOT?>/assets/css/headers.css" rel="stylesheet">  
<link href="<?=ROOT?>assets/css/carousel.css" rel="stylesheet">

  </head>
  <body >
 
  <header class="p-3 mb-3 border-bottom bg-danger">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="home" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <img src="<?=ROOT?>/assets/images/correctbg.png" width="32" height="40" alt="">
        </a>

        <!--php experimentation-->

        <?php 

        ?>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="home" class="nav-link px-2 link-secondary">Home</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">My stays</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Blogs</a></li>
          <li><a href="#" class="nav-link px-2 link-dark"></a></li>
        </ul>

        <form action="<?=ROOT?>/search" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <div class="input-group">
            <input value="<?=$_GET['find'] ?? ''?>" name="find" type="search" class="form-control" placeholder="Search..." aria-label="Search">
            <button>Search</button>
          </div>
        </form>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="admin">Admin</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="login">Sign in</a></li>
            <li><a class="dropdown-item" href="<?=ROOT?>/logout">log out</a></li>

          </ul>
        </div>
      </div>
    </div>
  </header>

 
      <!-- my carousel-->

      <?php 
      if ($url[0]== 'home')
      include '../app/pages/includes/carousel.php';
       ?>