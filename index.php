<?php 
include 'header.php';
include 'template-part/user.php';
Session::checksession();
 $user = new User();

 ?>

<br>
<br>
<br>
<?php 
  $loginmsg = Session::get("loginmsg");
  if (isset($loginmsg)) {
    echo $loginmsg;
  }
  Session::set("loginmsg", NULL);
 ?>

      <div class="card">
    <h5 class="card-header">Welcome <span class="float-right"><?php $name = Session::get("name"); if (isset($name)) { echo $name; } ?></span></h5>
   <div class="card-body">
      <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Username</th>
          <th scope="col">Enail</th>
          <th scope="col">prifile</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $user = new User();
          $i = 0;
          $userdata = $user->getUserData();
          if ($userdata) {
            foreach ($userdata as $sdata) { $i++; ?>
            
        <tr>
          <th scope="row"><?php echo $i; ?></th>
          <td><?php echo $sdata['name'] ?></td>
          <td><?php echo $sdata['username'] ?></td>
          <td><?php echo $sdata['email'] ?></td>
          <td><a href="profile.php?id=<?php echo $sdata['id'] ?>" class="btn btn-primary">View</a></td>
        </tr>
      <?php } }else{ ?><h2>no data found!!</h2><?php } ?>
      </tbody>
    </table>
    </div> 
  </div>
<br>
<br>
<br>

    
</div>

<?php include 'footer.php'; ?>
