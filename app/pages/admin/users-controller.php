<?php

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

  //validate image
  $allowed= ['image/jpeg','image/png', 'image/webp'];
  if (!empty($_FILES['image']['name'])){
    $destination ="";

    if(!in_array($_FILES['image']['type'], $allowed)){
      $errors['image'] = "Image format not supported";
    }else{
      $folder = "uploads/";
      if(!file_exists($folder))
      {
        mkdir($folder, 0777, true);
      }
      $destination = $folder.time().$_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'], $destination);
      resize_img($destination);
    }
  }

  if (empty($errors)){
    //save to database
    $data=[];
    $data['username']= $_POST['username'];
    $data['email']   = $_POST['email'];
    $data['role']    = $_POST['role'];
    $data['password']= password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "insert into users (username,email,password,role,image) values (:username,:email,:password,:role,:image)";

  if(!empty($destination))
          {
            $data['image']     = $destination;
            $query = "insert into users (username,email,password,role,image) values (:username,:email,:password,:role,:image)";
          }

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

          $allowed = ['image/jpeg','image/png','image/webp'];
          if(!empty($_FILES['image']['name']))
          {
            $destination = "";
            if(!in_array($_FILES['image']['type'], $allowed))
            {
              $errors['image'] = "Image format not supported";
            }else
            {
              $folder = "uploads/";
              if(!file_exists($folder))
              {
                mkdir($folder, 0777, true);
              }

              $destination = $folder . time() . $_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'], $destination);
              resize_img($destination);
            }
          }

          if (empty($errors)){
            //save to database
            $data=[];
            $data['username']= $_POST['username'];
            $data['email']   = $_POST['email'];
            $data['role']    = $_POST['role'];
            $data['id']      = $id;

            $password_str     = "";
            $image_str        = "";

              if(!empty($_POST['password']))
              {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $password_str = "password = :password, ";
              }

              if(!empty($destination))
              {
                $image_str = "image = :image, ";
                $data['image']       = $destination;
              }
            
              $query = "update users set username = :username, email = :email, $password_str $image_str role = :role where id = :id limit 1";

            query($query, $data);
            redirect('admin/users');
          }
        }
    }
  }else

  //delete section 
  if($action == 'delete')
  {
   
        $query = "select * from users where id = :id limit 1";
        $row   = query_row($query, ['id' =>$id]);

        if($_SERVER['REQUEST_METHOD'] == "POST")
        {

        if($row){

          //validate
          $errors=[];

          //errors


          if (empty($errors)){
            //delete from database
            $data=[];
            $data['id']      = $id;

           
            $query=" delete from users where id = :id limit 1";

            
            query($query,$data);

            redirect('admin/users');
        }
        }
    }
  }
