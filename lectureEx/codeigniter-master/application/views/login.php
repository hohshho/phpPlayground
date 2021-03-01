<div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: block;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
      </div>
      <form action="/ci1/auth/authentication/" method="post">
        <input type="hidden" name="returnURL" value="<?=$returnURL?>">
        <div class="modal-body">
            <div class="form-group">
              <label for="email" class="col-form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="password" class="col-form-label">Password</label>
              <input type="password" class="form-control" id="password" placeholder="password" name="password"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <a class="btn btn-primary" href="/ci1/topic" role="button">Cancel</a>
          <input type="submit" class="btn btn-primary" value="Login">
        </div>
      </form>
    </div>
  </div>
</div>
