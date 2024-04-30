<div class="container mt-5">
  <div class="row justify-content-center">
      <div class="col-md-6">
          <h2 class="mb-3">Login</h2>
          <?php if (!empty($message)): ?>
              <div class="alert alert-danger" role="alert">
                  <?= $message; ?>
              </div>
          <?php endif; ?>
          <form name="frmLogin" action="authenticate.php" method="post">
              <div class="mb-3">
                  <label for="txtid" class="form-label">Student ID</label>
                  <input name="txtid" type="text" class="form-control" id="txtid" required>
              </div>
              <div class="mb-3">
                  <label for="txtpwd" class="form-label">Password</label>
                  <input name="txtpwd" type="password" class="form-control" id="txtpwd" required>
              </div>
              <button type="submit" value="Login" name="btnlogin" class="btn btn-primary">Login</button>
          </form>
      </div>
  </div>
</div>