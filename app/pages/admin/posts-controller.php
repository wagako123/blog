t<?php

//add new form control

  if($action == 'add')
  {
    if(!empty($_POST))
    {

  //validate
  $errors=[];

  //errors

  if(empty($_POST['title'])){
    $errors['title']="title required";
  }
  if(empty($_POST['category_id'])){
    $errors['category_id']="category required";
  }
  if(empty($_POST['content'])){
    $errors['content']="content required";
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

  $slug = str_to_url($_POST['title']);

      $query = "select id from posts where slug = :slug limit 1";
      $slug_row = query($query, ['slug'=>$slug]);

      if($slug_row)
      {
        $slug .= rand(1000,9999);
      }

  if (empty($errors)){
    //save to database
    $data=[];
    $data['title']      = $_POST['title'];
    $data['slug']       = $slug;
    $data['content']    = $_POST['content'];
    $data['category_id']= $_POST['category_id'];
    $data['user_id']    =user ('id');

    $query = "insert into posts (title,slug,category_id,content,user_id ) values (:title,:slug,:category_id,:content,:user_id)";


  if(!empty($destination))
          {
            $data['image']     = $destination;
            $query = "insert into posts (title,slug,category_id,content,image,user_id) values (:title,:slug,:category_id,:content,:image,:user_id)";
          }

    query($query,$data);


    redirect('admin/posts');
 }
}
  }
//EDIT SECTION
if($action == 'edit')
  {
   
        $query = "select * from posts where id = :id limit 1";
        $row   = query_row($query, ['id' =>$id]);

        if(!empty($_POST))
        {

        if($row){

          //validate
          $errors=[];

          //errors

          if(empty($_POST['title'])){
            $errors['title']="title required";
          }
          if(empty($_POST['category_id'])){
            $errors['category_id']="category required";
          }
          if(empty($_POST['content'])){
            $errors['content']="content required";
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
            $data['title']     = $_POST['title'];
            $data['content']   = $_POST['content'];
            $data['category_id']    = $_POST['category_id'];
            $data['id']      = $id;

            $password_str     = "";
            $image_str        = "";

              

              if(!empty($destination))
              {
                $image_str = "image = :image, ";
                $data['image']       = $destination;
              }
            
              $query = "update posts set title = :title, content = :content, $image_str category_id = :category_id where id = :id limit 1";

            query($query, $data);
            redirect('admin/posts');
          }
        }
    }
  }else

  //delete section 
  if($action == 'delete')
  {
   
        $query = "select * from posts where id = :id limit 1";
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

           
            $query=" delete from posts where id = :id limit 1";

            
            query($query,$data);
            
            if(file_exists($row['image']))
            unlink($row['image']);

            redirect('admin/posts');
        }
        }
    }
  }
