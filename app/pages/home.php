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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      
  </body>
</html>
