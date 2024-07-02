<?php

if(!empty($_POST))
{

  //validate
  $errors=[];

  //errors

  if(empty($_POST['username'])){
    $errors['username']="username required";
  }else 
  if(!preg_match("/^[a-zA-Z]+$/", $_POST['username'])){
    $errors['username'] = "username cannot have spaces";
  }else

  $query = "select id from users where email = :email limit 1";
  $email = query($query, ['email'=>$_POST['email']]);
  // email search for existing email does not work because Query function in function does 
  // not allow for null arrays while the tutorial dictates that it should work anyway
//  passwordone
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
  // if(empty($_POST['terms'])){
  //   $errors['terms']="Please accept the terms and conditions";
  // }

  if (empty($errors)){
    //save to database
    $data=[];
    $data['username']= $_POST['username'];
    $data['email']   = $_POST['email'];
    $data['role']    = "user";
    $data['password']= password_hash($_POST['password'], PASSWORD_DEFAULT);


    $query=" insert into users(username,email,password,role) values(:username,:email,:password,:role)";
    query($query,$data);

    redirect('login');
 }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    
    <title>Signup- <?= APP_NAME?> </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <link href="blog/assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form method="post">
  <a href="home">
    <img class="mb-4" src="blog/public/assets/images/correctbg.png" alt="" width="72" height="57">
    </a>
    <h1 class="h3 mb-3 fw-normal">Please create an account</h1>

    <?php if (!empty($errors)):?>
      <div class="alert alert-danger">Please fix errors below </div>
      <?php endif;?>
    <div class="form-floating">

      <input value="<?=old_value("email")?>" name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <?php if (!empty($errors['email'])):?>
      <div class="alert alert-danger"><?=$errors['email'] ?> </div>
      <?php endif;?>
    <div class="form-floating">
      <input value="<?=old_value("username")?>" name="username" type="text" class="form-control" id="username" placeholder="username">
      <label for="floatingInput">Username</label>
    </div>
    <?php if (!empty($errors['username'])):?>
      <div class="alert alert-danger"><?=$errors['username'] ?> </div>
      <?php endif;?>
    <div class="form-floating">
      <input value="<?=old_value("password")?>" name="password" type="password" class="form-control" id="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <?php if (!empty($errors['password'])):?>
      <div class="alert alert-danger"><?=$errors['password'] ?> </div>
      <?php endif;?>
    <div class="form-floating">
      <input value="<?=old_value("password")?>" name="retype_password" type="password" class="form-control" id="retyped_password" placeholder="Password">
      <label for="floatingPassword">Re-type Password</label>
    </div>

    <div class="my-2"><a href="login">Login to your account</a></div>

    <!-- <div class="checkbox mb-3">
      <label>
        <input name="terms" type="checkbox" value="remember-me"> Accept terms and conditions
      </label>
    </div>-->
    <?php 
    //if (!empty($errors['terms'])):?>
      <div class="alert alert-danger"><?=$errors['terms'] ?> </div>
      <?php //endif;?> 
    <button class="w-100 btn btn-lg btn-primary" type="submit">Create account</button>
    <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y")?> </p>
  </form>
</main>


    
  </body>
</html>
