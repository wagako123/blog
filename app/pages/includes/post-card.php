<div class="container col-lg-4 position-relative">
  <div class="row border overflow-hidden flex-md-row mb-2 shadow-sm  ">
      <a href="<?=ROOT?>/post/<?=$row['slug']?>">
        <div class="p-2">
          <!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg> -->
          <img class="bd-placeholder-img rounded-circle" width="140" height="140" style="object-fit: cover;" src="<?= get_image($row['image']) ?>">
          <h2><?=esc($row['title'])?></h2>
          <strong class="nav-link-dark"><a href="<?=ROOT?>/category/<?=$row['category']?>"><?= esc($row['category'] ?? 'Unknown') ?></a></strong>
          <p><?=date("jS M, Y",strtotime($row['date']))?></p>
          <p><?=esc(substr($row['content'], 0, 200))?></p>
          <p><a class="btn btn-secondary" href="<?=ROOT?>/post/<?=$row['slug']?>">View details &raquo;</a></p>
        </div>
      </a>
  </div>
</div>