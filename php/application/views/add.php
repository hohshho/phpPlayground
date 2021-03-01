<form action="/topic/add" method="post" class="span10">
    <?php echo validation_errors(); ?>
    <input type="text" name="title" placeholder="제목" class="span12" />
    <textarea name="description" placeholder="본문" class="span12" rows="15" ></textarea>
    <input class="btn" type="submit" />
</form>
<!-- <script src="./lib/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description',{
        'filebrowserUploadUrl':'/topic/upload_receive_from_ck'
    });
</script> -->