<?php if($action == 'add'): ?>

<div class="col-md-6 mx-auto">
    <div class="form-floating">
    <form method="post">
  

    <?php if (!empty($errors)):?>
      <div class="alert alert-danger">Please fix errors below </div>
      <?php endif;?>
      <a href="<?=ROOT?>/admin/users">
        <button class="mt-4 w-100 btn btn-lg btn-primary" type="button">back</button>
        </a>
    <div class="form-floating mt-4">

      <input value="<?=old_value("email")?>" name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <?php if (!empty($errors['email'])):?>
      <div class="alert alert-danger"><?=$errors['email'] ?> </div>
      <?php endif;?>
    <div class="form-floating">
      <input value="<?=old_value("username")?>" name="username" type="text" class="form-control" id="floatingInput" placeholder="username">
      <label for="floatingInput">Username</label>
    </div>
    <?php if (!empty($errors['username'])):?>
      <div class="alert alert-danger"><?=$errors['username'] ?> </div>
      <?php endif;?>
    <div class="form-floating">
      <input value="<?=old_value("password")?>" name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <?php if (!empty($errors['password'])):?>
      <div class="alert alert-danger"><?=$errors['password'] ?> </div>
      <?php endif;?>
    <div class="form-floating">
      <input value="<?=old_value("password")?>" name="retype_password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Re-type Password</label>
    </div>

    
   
    <button class="mt-4 w-100 btn btn-lg btn-primary" type="submit">Create account</button>
    <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y")?> </p>
  </form>
  </div>


<?php elseif($action == 'edit'):?>

  <div class="col-md-6 mx-auto">
    <div class="form-floating">
    <form method="post">
  
    <?php if (!empty($row)):?>
      <?php if (!empty($errors)):?>
        <div class="alert alert-danger">Please fix errors below </div>
        <?php endif;?>
        
        
        
        <a href="<?=ROOT?>/admin/users">
         <button class="mt-4 w-100 btn btn-lg btn-primary" type="button">back</button>
        </a>

        <div class="my-2 mt-2">
          <label class="d-block">
            <img class="mx-auto " src=" <?=get_image($row['image']) ?>" style="width: 100px; height: 100px; object-fit:cover;">
            <input onchange="display_image_edit(this.files[0])" type="file" name="image" >
          </label>
        </div>

        <script>
          function display_image_edit(file){
            document.querySelector(".image-preview-edit").src =URL.createObjectURL(file);
          }
          </script>

        
        <div class="form-floating mt-2">

          <input value="<?=old_value("email", $row['email'])?>" name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Email address</label>
        </div>
        <?php if (!empty($errors['email'])):?>
          <div class="alert alert-danger"><?=$errors['email'] ?> </div>
          <?php endif;?>
        <div class="form-floating">
          <input value="<?=old_value('username', $row['username'])?>" name="username" type="text" class="form-control" id="floatingInput" placeholder="username">
          <label for="floatingInput">Username</label>
        </div>
        <?php if (!empty($errors['username'])):?>
          <div class="alert alert-danger"><?=$errors['username'] ?> </div>
          <?php endif;?>
        <div class="form-floating">
          <input value="<?=old_value("password")?>" name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password(leave empty to keep previous password)</label>
        </div>
        <?php if (!empty($errors['password'])):?>
          <div class="alert alert-danger"><?=$errors['password'] ?> </div>
          <?php endif;?>
          <div class="form-floating">
          <input value="<?=old_value("password")?>" name="retype_password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Re-type Password(leave empty to keep previous password)</label>
        </div>

      
    
      <button class="mt-4 w-100 btn btn-lg btn-primary" type="submit">edit account</button>
      <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y")?> </p>
      <?php else :?>
          <div class="alert alert-danger text-center" >Record Not found</div>
      <?php endif ;?>
  </form>
  </div>

<?php elseif($action == 'delete'):?>
  <div class="col-md-6 mx-auto">
    <div class="form-floating">
    <form method="post">
  
    <?php if (!empty($row)):?>
      <?php if (!empty($errors)):?>
        <div class="alert alert-danger">Please fix errors below </div>
        <?php endif;?>
        <a href="<?=ROOT?>/admin/users">
        <button class="mt-4 w-100 btn btn-lg btn-primary" type="button">back</button>
        </a>
      <div >

        <div ><?=old_value("email", $row['email'])?></div>
        
      </div>
      <?php if (!empty($errors['email'])):?>
        <div class="alert alert-danger"><?=$errors['email'] ?> </div>
        <?php endif;?>
      <div >
        <div > <?=old_value('username', $row['username'])?></div>
        
      </div>
      
    
      <button class="mt-4 w-100 btn btn-lg btn-danger" type="submit">delete account</button>
      <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y")?> </p>
      <?php else :?>
          <div class="alert alert-danger text-center" >Record Not found</div>
      <?php endif ;?>
  </form>
  </div>
<?php else:?>   

<h4>Users 
  
    <a href="<?=ROOT?>/admin/users/add">
    <button class="btn btn-primary">
    Add new
    </button>
    </a>

</h4>

<div class="table-responsive">
<table class="table">
    <tr>
        <th>#</th>
        <th>Useraname</th>
        <th>image</th>
        <th>role</th>
        <th>Image</th>
        <th>date</th>
        <th>Action</th>
    </tr>

    <?php

      $limit  = 10;
      $offset = ($PAGE['page_number']-1)* $limit;

        $query="select * from users order by id desc limit $limit offset $offset";
        $rows= query($query);
        ?>
            <!-- check for users active because of log out bug -->
        <!-- <h4><?= logged_in()?></h4> -->
    <?php if(!empty($rows)):?>
        <?php foreach($rows as $row): ?>
    <tr>
        <td><?=$row['id']?></td>
        <td><?=esc($row['username'])?></td>
        <td><?=$row['email']?></td>
        <td><?=$row['role']?></td>
        <td>
          <img src=" <?=get_image($row['image']) ?>" style="width: 100px; height: 100px; object-fit:cover;">
        </td>
        <td><?=date ("jS M, Y",strtotime($row['date']))?></td>
        <td class="padding-between">
          <a href="<?=ROOT?>/admin/users/edit/<?=$row['id']?>">
            <button class="btn btn-warning btn-sm text-white "><i class="bi bi-pencil-square"></i></button>
            </a>
            <a href="<?=ROOT?>/admin/users/delete/<?=$row['id']?>">
            <button class="btn btn-danger btn-sm "><i class="bi bi-person-dash"></i></button>
            </a>
        </td>
    </tr>

    

            <?php endforeach; ?>
        <?php endif; ?>
</table>
</div>
<div class="col-md-12 mb-4">
  <a href="<?=$PAGE['first_link']?>">
     <button class="btn btn-primary">First page</button>
  </a>
  <a href="<?=$PAGE['prev_link']?>">
    <button class="btn btn-primary">prev page</button>
  </a>
  <a href="<?=$PAGE['next_link']?>">

          <button class="btn btn-primary float-end">next page</button>
  </a>

</div>

<?php endif;?>