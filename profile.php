<?php include 'header.php';
include 'template-part/user.php';
Session::checksession();



if (isset($_GET['id'])) {
  $userid = (int)$_GET['id'];

}
$user = new User();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $Usrupdate = $user->userdataupdate($userid, $_POST);
 }

 ?>
<br>
<br>
<br>
      <div class="card">
    <h5 class="card-header">User Profile <span class="float-right"><a href="index.php" class="btn btn-primary">Back</a></span></h5>
    <div class="card-body">
  <div class="offset-sm-3 col-sm-6">
    <?php
    if (isset($Usrupdate)) {
      echo $Usrupdate;
    }
     $userdata = $user->getUserById($userid);
    if ($userdata) { ?>
    <form action="" method="post"  >
    <div class="form-group">
      <label for="exampleInputEmail1"> Name</label>
      <input name="name"  type="text" class="form-control" id="userName" aria-describedby="emailHelp" value="<?php echo $userdata->name; ?>">
      <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input  type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $userdata->email; ?>" name="email">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">User Name</label>
      <input name="username"  type="text" class="form-control" id="userName" aria-describedby="emailHelp" value="<?php echo $userdata->username; ?>">
      <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <?php $sesid = Session::get('id');
    if ($userid == $sesid) { ?>
    
    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a class="btn btn-info" href="changpass.php?id=<?php echo $userid; ?>">Change Password</a>
    <?php } ?>
  </form>
  <?php } ?>

</div>
</div> 
  </div>
<?php include 'footer.php'; ?>