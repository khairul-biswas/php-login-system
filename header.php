<?php 
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/template-part/section.php';
Session::init();
 ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="inc/bootstrap.css">

    <title>login system!</title>
  </head>
  <body>
    <?php if (isset($_GET['action']) && $_GET['action'] == 'logout') {
      Session::destroy();
    } ?>
<div class="container">    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <?php 
            $id = Session::get("id");
            $userLogin = Session::get("login");
            if ($userLogin == true) { ?>
          <li class="nav-item">
            <a class="nav-link" href="profile.php?id=<?php echo $id ?>">profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?action=logout">logout</a>
          </li>
            <?php }else{ ?>
          <li class="nav-item active">
            <a class="nav-link" href="login.php">Login<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
        <?php } ?>
        </ul>
      </div>
    </nav>