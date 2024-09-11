<?php        include '../app/pages/includes/header.php'; ?>
  
<div class="mx-auto col-md-10" >
    <h3 class="mx-4"> Post</h3>

      <!-- Three columns of text below the carousel -->
      <div class="row justify-content-center">

        
        <?php 
        
        $slug= $url[1] ?? null;

        if($slug){
          $query= "select posts.*,categories.category from posts join categories on posts.category_id= categories.id  where posts.slug = :slug limit 1";
        $rows= query_row($query, ['slug'=> $slug]);
        }

        
        if($rows){?>
        
        <div>
        <a href="<?=ROOT?>/post/<?=$row['slug']?>">
          <div class="col-lg-4">
            <!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg> -->
            <img class="bd-placeholder-img rounded-circle" width="140" height="140" style="object-fit: cover;" src="<?= get_image($row['image']) ?>">
            <h2><?=esc($row['title'])?></h2>
            <strong><?= esc($row['category'] ?? 'Unknown') ?></strong>
            <p><?=date("jS M, Y",strtotime($row['date']))?></p>
            <p><?=esc(substr($row['content'], 0, 200))?></p>
            <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
          </div>
        </a>

            <?php
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

