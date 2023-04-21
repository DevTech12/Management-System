<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" >
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Signup to Forum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/forum/partial/_handleSignup.php" method="POST">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp" required>
          
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="signupPassword" name="signupPassword" required>
        </div>
        <div class="form-group">
          <label for="cpassword">Confirm Password</label>
          <input type="password" class="form-control" id="signupcPassword" name="signupcPassword" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Sign Up</button>
      </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div> 