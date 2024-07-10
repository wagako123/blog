<?php

if(!empty($_POST)){
//validate
$errors=[];

$query=" select * from users where email = :email limit 1";
$row=query($query,['email'=> $_POST['email']]);


if ($row){
  $data=[];
  if(password_verify($_POST['password'], $row[0]['password'] ))
  {
    //grant access

  authenticate($row[0]);
 
  redirect('admin');

}else{
  $errors['email']="wrong email or password";
}
}

else{
  $errors['email']="wrong email or password";
}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    
    <title>Login - <?= APP_NAME?>  </title>

    

    

    <!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
 crossorigin="anonymous">

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
    <link href="assets\css\signin.css" rel="stylesheet" type="text/css">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form method="post">
    <a href="home">
    <img class="mb-4" src="assets/images/correctbg.png" alt="" width="72" height="57">
    </a>

   
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <?php if (!empty($errors['email'])):?>
      <div class="alert alert-danger"><?=$errors['email'] ?> </div>
      <?php endif;?>
   
    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="my-2"> Don't have an account? <a href="signup"> sign up here </a></div>
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="1"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y")?> </p>
  </form>
</main>


    
  </body>
</html>
