<div class="col-2">
  <ul class="nav flex-column">

    <?php
      foreach($topics as $entry){
    ?>
        <li class="nav-item"><a href="/ci1/topic/get/<?=$entry->id?>" class="text-success"><?=$entry->title?></a></li>
    <?php
      }
    ?>
  </ul>
</div>
