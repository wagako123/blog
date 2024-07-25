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
