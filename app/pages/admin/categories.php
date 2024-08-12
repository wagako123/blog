<?php if($action == 'add'): ?>

<div class="col-md-6 mx-auto">
    <div class="form-floating">
    <form method="post">

    <h1>Create category</h1>
  

    <?php if (!empty($errors)):?>
      <div class="alert alert-danger">Please fix errors below </div>
      <?php endif;?>
      
      <a href="<?=ROOT?>/admin/categories">
        <button class="mt-4 w-100 btn btn-lg btn-primary" type="button">back</button>
        </a>
    
    <div class="form-floating">
      <input value="<?=old_value("category")?>" name="category" type="text" class="form-control" id="floatingInput" placeholder="category">
      <label for="floatingInput">category</label>
    </div>

    <?php if (!empty($errors['category'])):?>
      <div class="alert alert-danger"><?=$errors['category'] ?> </div>
      <?php endif;?>

    
    <div class="form-floating">
      <div class="form-floating mt-4 mb-2">
      <select name=role class="form-select">
        <option value="0">Yes</option>
        <option value="1">No</option>

      </select>
      <label for="FloatingInput">Active</label>
    </div>
    
    
    
    
   
    <button class="mt-4 w-100 btn btn-lg btn-primary" type="submit">Create category</button>
    <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y")?> </p>
  </form>
  </div>


<?php elseif($action == 'edit'):?>

  <div class="col-md-6 mx-auto">
    <div class="form-floating">
    <form method="post">

    <h1>Edit category</h1>
  
  
    <?php if (!empty($row)):?>
      <?php if (!empty($errors)):?>
        <div class="alert alert-danger">Please fix errors below </div>
        <?php endif;?>
        
        
        
        <a href="<?=ROOT?>/admin/categories">
         <button class="mt-4 w-100 btn btn-lg btn-primary" type="button">back</button>
        </a>

        

        
        
        <div class="form-floating">
          <input value="<?=old_value('category', $row['category'])?>" name="category" type="text" class="form-control" id="floatingInput" placeholder="category">
          <label for="floatingInput">category</label>
        </div>
       
        <div class="form-floating">
           <div class="form-floating mt-4 mb-2">
            <select name=disabled class="form-select">
              <option <?=old_selected('disabled', 'user', $row['disabled'])?> value="0 ">Yes</option>
              <option <?=old_selected('disabled', 'admin',$row['disabled'])?> value="1">no</option>
              <label for="floatingInput">Active</label>
            </select>
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

    <h1>Delete category</h1>
  
    
  
    <?php if (!empty($row)):?>
      <?php if (!empty($errors)):?>
        <div class="alert alert-danger">Please fix errors below </div>
        <?php endif;?>
        <a href="<?=ROOT?>/admin/categories">
        <button class="mt-4 w-100 btn btn-lg btn-primary" type="button">back</button>
        </a>
      <div >

        <div ><?=old_value("category", $row['category'])?></div>
        
      </div>
      <?php if (!empty($errors['category'])):?>
        <div class="alert alert-danger"><?=$errors['category'] ?> </div>
        <?php endif;?>
      
      <div >
        <?php if(!empty($errors['username'])):?>
        <div > <?=old_value('username', $row['username'])?></div>
        <?php endif;?>
      </div>
      
    
      <button class="mt-4 w-100 btn btn-lg btn-danger" type="submit">delete account</button>
      <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y")?> </p>
      <?php else :?>
          <div class="alert alert-danger text-center" >Record Not found</div>
          
      <?php endif ;?>
  </form>
  </div>
<?php else:?>   

<h4>Categories 
  
    <a href="<?=ROOT?>/admin/categories/add">
    <button class="btn btn-primary">
    Add new
    </button>
    </a>

</h4>

<div class="table-responsive">
<table class="table">
    <tr>
        <th>#</th>
        <th>Category</th>
        <th>Slug</th>
        <th>Disabled</th>
        <th>Action</th>
        
    </tr>

    <?php

      $limit  = 10;
      $offset = ($PAGE['page_number']-1)* $limit;

        $query="select * from categories order by id desc limit $limit offset $offset";
        $rows= query($query);
        ?>
            <!-- check for categories active because of log out bug -->
        <!-- <h4><?= logged_in()?></h4> -->
    <?php if(!empty($rows)):?>
        <?php foreach($rows as $row): ?>
    <tr>
        <td><?=$row['id']?></td>
        <td><?=esc($row['category'])?></td>
        <td><?=$row['slug']?></td>
        <td><?=$row['disabled'] ?></td>
        

        <td class="padding-between">
          <a href="<?=ROOT?>/admin/categories/edit/<?=$row['id']?>">
            <button class="btn btn-warning btn-sm text-white "><i class="bi bi-pencil-square"></i></button>
            </a>
            <a href="<?=ROOT?>/admin/categories/delete/<?=$row['id']?>">
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