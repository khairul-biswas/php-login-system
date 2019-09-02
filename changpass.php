<?php include 'header.php';
include 'template-part/user.php';
Session::checksession();



if (isset($_GET['id'])) {
  $userid = (int)$_GET['id'];
  $sesid = Session::get('id');
    if ($userid != $sesid){
      header('Location:index.php');
    }
  }
$user = new User();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatepass'])) {
  $updatepass = $user->updatePassword($userid, $_POST);


 }

 ?>
<br>
<br>
<br>
      <div class="card">
    <h5 class="card-header">Change Password<span class="float-right"><a href="profile.php?id=<?php echo $userid; ?>" class="btn btn-primary">Back</a></span></h5>
    <div class="card-body">
  <div class="offset-sm-3 col-sm-6">
    <?php
    if (isset($updatepass)) {
      echo $updatepass;
    } ?>
    <form action="" method="post"  >
    <div class="form-group">
      <label for="exampleInputPassword1">Old Password</label>
      <input  type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="oldpass">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">New Password</label>
      <input  type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="newpass">
    </div>
    
    <button type="submit" name="updatepass" class="btn btn-primary">Update Password</button>
  </form>

</div>
</div> 
  </div>
<?php include 'footer.php'; ?>