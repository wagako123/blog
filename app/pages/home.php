<?php        include '../app/pages/includes/header.php'; ?>
  <main class="p-2 flex-row">

  <h3 class="mx-4">  Featured</h3>

    <!-- Three columns of text below the carousel -->
    <div class="row justify-content-center">

      
      <?php 
      $query= "select posts.*,categories.category from posts join categories on posts.category_id= categories.id order by id desc limit 6";
      $rows= query($query);
      if($rows){
        foreach ($rows as $row){
          include '../app/pages/includes/post-card.php';
        }
        
      }else{
        echo "No items found";
      }
      
      
      ?>
    </div><!-- /.row -->

</main>


  <!-- Footer-->
    
      <?php  include '../app/pages/includes/footer.php'; ?>

