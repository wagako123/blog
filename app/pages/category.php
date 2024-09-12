<?php        include '../app/pages/includes/header.php'; ?>
  
<div class="mx-auto col-md-10" >
    <h3 class="mx-4"> Category</h3>

      <!-- Three columns of text below the carousel -->
      <div class="row justify-content-center">

        
        <?php 
        $limit  = 10;
        $offset = ($PAGE['page_number']-1)* $limit;

        $category_slug = $url[1] ?? null;


        if($category_slug){
        $query= "select posts.*,categories.category from posts join categories on posts.category_id= categories.id where posts.category_id in ( select id from categories where slug =:category_slug) order by id desc limit $limit offset $offset";
        $rows= query($query, ['category_slug'=> $category_slug]);

        }
        if(!empty($rows)){
          foreach ($rows as $row){
            include '../app/pages/includes/post-card.php';
          }
          
        }else{
          echo "No items found";
        }
        
        
        ?>
      </div><!-- /.row -->



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
</div>


  <!-- Footer-->
    
      <?php  include '../app/pages/includes/footer.php'; ?>

