<?php include 'header.php';
include 'template-part/user.php';
 $user = new User();
 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $Usrregi = $user->userRegistraton($_POST);
 }

 ?>
<br>
<br>
<br>
      <div class="card">
    <h5 class="card-header">User Registrtion</span></h5>
    <div class="card-body">
  <div class="offset-sm-3 col-sm-6">
    <?php if (isset($Usrregi)) {
      echo $Usrregi;
    } ?>
    <form action="" method="post"  >
    <div class="form-group">
      <label for="exampleInputEmail1"> Name</label>
      <input name="name"  type="text" class="form-control" id="userName" aria-describedby="emailHelp" placeholder="Enter  Name">
      <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input  type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">User Name</label>
      <input name="username"  type="text" class="form-control" id="userName" aria-describedby="emailHelp" placeholder="Enter User Name">
      <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input  type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Register</button>
  </form>

</div>
</div> 
  </div>
<?php include 'footer.php'; ?>