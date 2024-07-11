<h4>Users </h4>

<table class="table">
    <tr>
        <th>#</th><th>Useraname</th><th>image</th><th>role</th><th>Image</th><th>date</th>
    </tr>

    <?php

        $query="select * from users order by id desc";
        $rows= query($query);
        ?>
    <?php if(!empty($rows)):?>
        <?php foreach($rows as $row): ?>
    <tr>
        <th><?=$row['id']?></th>
        <th><?=$row['username']?></th>
        <th><?=$row['email']?></th>
        <th><?=$row['role']?></th>
        <th>Image</th>
        <th><?=$row['date']?></th>
    </tr>
            <?php endforeach; ?>
        <?php endif; ?>
</table>