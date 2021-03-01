<div class="col-sm-10">
  <article>
    <h1><?=$topic->title?></h1>
    <div>
      <div><?=kdate($topic->created)?></div>
      <?=auto_link($topic->description)?>
    </div>
  </article>
  <div>
      <form action='/ci1/topic/delete' method='post'>
        <input type='hidden' name="topic_id" value="<?=$topic->id?>" />
        <a href="/ci1/topic/add" class="btn btn-primary">추가</a>
        <input type="submit" class="btn" value="삭제" />
      </form>
  </div>
</div>
