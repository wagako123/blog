<?php if($action == 'add'): ?>

<div class="col-md-6 mx-auto">
    <div class="form-floating">
    <form method="post" enctype="multipart/form-data">
  

    <?php if (!empty($errors)):?>
      <div class="alert alert-danger">Please fix errors below </div>
      <?php endif;?>

      <div class="my-2">
        Featured image: </br>
	    	<label class="d-block">
	    		<img class="mx-auto d-block image-preview-edit" src="<?=get_image('')?>" style="cursor: pointer;width: 150px;height: 150px;object-fit: cover;">
	    		<input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none">
	    	</label>
	    	<?php if(!empty($errors['image'])):?>
		      <div class="text-danger"><?=$errors['image']?></div>
		    <?php endif;?>

	    	<script>
	    		
	    		function display_image_edit(file)
	    		{
	    			document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
	    		}
	    	</script>
	    </div>
      <a href="<?=ROOT?>/admin/posts">
        <button class="mt-4 w-100 btn btn-lg btn-primary" type="button">back</button>
        </a>
    <div class="form-floating mt-4">

      <input value="<?=old_value("title")?>" name="title" type="title" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Title</label>
    </div>
    <?php if (!empty($errors['title'])):?>
      <div class="alert alert-danger"><?=$errors['title'] ?> </div>
      <?php endif;?>
    <div class="form-floating">
      <div class="form-floating mt-4 mb-2">
      <select name="category_id" class="form-select">
        
        <?php
        $query="select * from categories order by id desc";
        $categories= query($query);
        
        ?>

        <option value="">--SELECT--</option>
        <?php if(!empty($categories)): ?>
            <?php foreach($categories as $cat): ?>
                <option value="<?=$cat['id']?>"><?=$cat['category']?></option>
                <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </div>
    <?php if (!empty($errors['category_id'])):?>
      <div class="alert alert-danger"><?=$errors['category_id'] ?> </div>
      <?php endif;?>
    <div >
      <textarea rows='8' name="content" type="text" class="form-control" id="floatingInput" placeholder="Post content"><?=old_value("content")?></textarea>
    </div>
    <?php if (!empty($errors['content'])):?>
      <div class="alert alert-danger"><?=$errors['content'] ?> </div>
      <?php endif;?>
    
   
    <button class="mt-4 w-100 btn btn-lg btn-primary" type="submit">Create post</button>
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
        
        
        
        <a href="<?=ROOT?>/admin/posts">
         <button class="mt-4 w-100 btn btn-lg btn-primary" type="button">back</button>
        </a>

        <div class="my-2 mt-2">
          <label class="d-block">
            <img class="mx-auto d-block image_preview_edit" src=" <?=get_image($row['image']) ?>" style="cursor: pointer; width: 100px; height: 100px; object-fit:cover;">
            <input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none" >
          </label>
        

        <script>
          function display_image_edit(file){
            document.querySelector(".image-preview-edit").src =URL.createObjectURL(file);
          }
          </script>

        </div>

        
        <div class="form-floating mt-4">

          <input value="<?=old_value("title", $row['title'])?>" name="title" type="title" class="form-control" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Title</label>
        </div>
          <?php if (!empty($errors['title'])):?>
            <div class="alert alert-danger"><?=$errors['title'] ?> </div>
          <?php endif;?>
          <div class="form-floating">
            <div class="form-floating mt-4 mb-2">
               <select name="category_id" class="form-select">
              
                  <?php
                  $query="select * from categories order by id desc";
                  $categories= query($query);
                  
                  ?>

                  <option value="">--SELECT--</option>
                <?php if(!empty($categories)): ?>
                    <?php foreach($categories as $cat): ?>
                        <option <?=old_selected('category_id', $cat['id'],$row['category_id'])?> value="<?=$cat['id']?>">
                          <?=$cat['category']?>
                        </option>
                        <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
            <?php if (!empty($errors['category_id'])):?>
               <div class="alert alert-danger"><?=$errors['category_id'] ?> </div>
            <?php endif;?>
            <div >
                <textarea rows='8' name="content" type="text" class="form-control" id="floatingInput" placeholder="Post content"><?=old_value("content", $row['content'])?></textarea>
            </div>
            <?php if (!empty($errors['content'])):?>
                <div class="alert alert-danger"><?=$errors['content'] ?> </div>
            <?php endif;?>

      
    
      <button class="mt-4 w-100 btn btn-lg btn-primary" type="submit">edit post</button>
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
        <a href="<?=ROOT?>/admin/posts">
        <button class="mt-4 w-100 btn btn-lg btn-primary" type="button">back</button>
        </a>
      <div class="form-floating">

        <div class="form-control mb-2"><?=old_value("title", $row['title'])?></div>
        
      </div>
      <?php if (!empty($errors['title'])):?>
        <div class="alert alert-danger"><?=$errors['title'] ?> </div>
        <?php endif;?>
      
      <div class="form-floating">
        <div class="form-control mb-2"> <?=old_value('slug', $row['slug'])?></div>
        
      </div>
      
    
      <button class="mt-4 w-100 btn btn-lg btn-danger" type="submit">delete post</button>
      <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y")?> </p>
      <?php else :?>
          <div class="alert alert-danger text-center" >Record Not found</div>
      <?php endif ;?>
  </form>
  </div>
<?php else:?>   

<h4>posts 
  
    <a href="<?=ROOT?>/admin/posts/add">
    <button class="btn btn-primary">
    Add new
    </button>
    </a>

</h4>

<div class="table-responsive">
<table class="table">
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Slug</th>
        <th>Image</th>
        <th>Date</th>
        <th>Action</th>

    </tr>

    <?php

      $limit  = 10;
      $offset = ($PAGE['page_number']-1)* $limit;

        $query="select * from posts order by id desc limit $limit offset $offset";
        $rows= query($query);
        ?>
            <!-- check for posts active because of log out bug -->
        <!-- <h4><?= logged_in()?></h4> -->
    <?php if(!empty($rows)):?>
        <?php foreach($rows as $row): ?>
    <tr>
        <td><?=$row['id']?></td>
        <td><?=esc($row['title'])?></td>
        <td><?=$row['slug']?></td>
        <td>
          <img src=" <?=get_image($row['image']) ?>" style="width: 100px; height: 100px; object-fit:cover;">
        </td>
        <td><?=date ("jS M, Y",strtotime($row['date']))?></td>
        <td class="padding-between">
          <a href="<?=ROOT?>/admin/posts/edit/<?=$row['id']?>">
            <button class="btn btn-warning btn-sm text-white "><i class="bi bi-pencil-square"></i></button>
            </a>
            <a href="<?=ROOT?>/admin/posts/delete/<?=$row['id']?>">
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