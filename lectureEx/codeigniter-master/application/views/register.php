<div class="container">
  <div class="row">
    <div class="col-sm"></div>
    <div class="col-sm-8">
<?php echo validation_errors(); ?>
      <form class="form-horizontal" action="/ci1/auth/register" method="post">
        <div class="control-group">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" >
          </div>
          <div class="form-group">
            <label for="nickname">Nickname</label>
            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="nickname" value="<?php echo set_value('nickname'); ?>" >
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" >
          </div>
          <div class="form-group">
            <label for="re_password">Check Password</label>
            <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Check Password" value="<?php echo set_value('re_password'); ?>" >
          </div>
          <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
      </form>
    </div>
    <div class="col-sm"></div>
  </div>
</div>
