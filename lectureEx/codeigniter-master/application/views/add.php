<script src="/ci1/vendor/ckeditor/ckeditor/ckeditor.js"></script>
<form action="/ci1/topic/add" method="post" class="col-sm-10">
  <div class="form-group">
    <?php echo validation_errors(); ?>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="title"  placeholder="제목">
  </div>
  <div class="form-group">
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="15" name="description" placeholder="본문"></textarea>
  </div>
  <button type="submit" class="btn btn-primary" >추가</button>
</form>

<script>
  CKEDITOR.addCss( '.cke_editable { font-size: 15px; padding: 2em; }' );

  CKEDITOR.replace( 'description', {

    // Configure your file manager integration. This example uses CKFinder 3 for PHP.
    // filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserImageUploadUrl: '/ci1/topic/upload_receive_from_ck?command=FileUpload&type=Images&currentFolder=/ci1/topic/add',
  } );
</script>


<!--
<script>
  CKEDITOR.replace( 'description', {
      'filebrowserUploadUrl': '/ci1/topic/upload_receive_from_ck'
  });
</script>
-->
