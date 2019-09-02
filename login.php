<?php include 'header.php';
include 'template-part/user.php';
Session::checklogin();
 $user = new User();
 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $Usrlogin = $user->userLogin($_POST);
 }

 ?>
<br>
<br>
      <div class="card">
    <h5 class="card-header"> User Login</h5>
 <div class="card-body">
      <div class="offset-sm-3 col-sm-6">
         <?php if (isset($Usrlogin)) {
      echo $Usrlogin;
      
    } ?>
    <form action="" method="post"  >
      
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" >
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input  name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" name="login" class="btn btn-primary">Submit</button>
  </form>

</div>
    </div> 
  </div>
<?php include 'footer.php'; ?>