<?php 
/**
 * 
 */
include 'template-part/database.php';
class User { 
  Private $db;
  public  function __construct(){
    $this->db = new Database();
  }
  public function userRegistraton($data){

  	$name 		= $data['name'];
  	$username 	= $data['username'];
  	$email 		= $data['email'];
  	$password 	= $data['password'];

  	$chk_email 	= $this->emailCheck($email);


/*validation input data*/
  	

  	if ($name == '' or $username == '' or $email == '' or $password == '') {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  Field must not be Empty</div>';
  		return $msg;
  	}
  	if (strlen($username) < 3) {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  User Name Too Short </div>';
  		return $msg;
  	}elseif (preg_match('/[^a-z0-9_-]+/i',$username)) {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  Username must only contain alphanumerical, dashes and underscore!</div>';
  		return $msg;
  	}
  	if (strlen($password) < 6) {$msg = '<div class="alert alert-danger" role="alert">Error!! Password Too Short.give above 6 alphabet</div>';
  		return $msg;
  	}
  	if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  Email addres not valide! Give valid email address</div>';
  		return $msg;
  	}
  	if ($chk_email == true) {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  Email addres exist!</div>';
  		return $msg;
  	}
  		/*insert data in database*/
  	$sql 	= "INSERT INTO user_tbl (name, username, email, password) VALUES(:name, :username, :email, :password)";
  	$query 	= $this->db->pdo->prepare($sql);
  	$query->bindValue(':name', $name);
  	$query->bindValue(':username', $username);
  	$query->bindValue(':email', $email);
  	$query->bindValue(':password', $password);
  	$succregi = $query->execute();
  	if ($succregi) {
  		$msg = '<div class="alert alert-success" role="alert">Success!!  You have Successfull Register Thank you!</div>';
  		return $msg;
  	}else{
  		$msg = '<div class="alert alert-success" role="alert">Error!!  Plase try agane sonthing was wrong Thank you!</div>';
  		return $msg;

  	}

  }

 /* get login user data*/

  public function getLoginUser($email, $password){
  	$sql 	= "SELECT * FROM user_tbl WHERE email = :email AND password = :password LIMIT 1";
  	$query 	= $this->db->pdo->prepare($sql);
  	$query->bindValue(':email', $email);
  	$query->bindValue(':password', $password);
  	$query->execute();
  	$result = $query->fetch(PDO::FETCH_OBJ);
  	return $result;
  }

  /*for login user*/
  public function userLogin($data){
  	$email 		= $data['email'];
  	$password 	= $data['password'];

  	$chk_email 	= $this->emailCheck($email);


		/*validation input data*/
  	

  	if ( $email == '' or $password == '') {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  Field must not be Empty</div>';
  		return $msg;
  	}
  	if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  Email addres not valide! Give valid email address</div>';
  		return $msg;
  	}
  	if ($chk_email == false) {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  Email addres not exist!</div>';
  		return $msg;
  	}

  	$result = $this->getLoginUser($email, $password);

  	if ($result) {
  		Session::init();
  		Session::set("login", true);
  		Session::set("id", $result->id);
  		Session::set("name", $result->name);
  		Session::set("username", $result->username);
  		Session::set('loginmsg', '<div class="alert alert-success" role="alert">Successfull  You are Logrd id</div>');
  		header("Location: index.php");
  	}else{
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  data not found!</div>';
  		return $msg;

  	}

  }

/*  if email adress exist for registration system*/
  public function emailCheck($email){
  	$sql 	= "SELECT email FROM user_tbl WHERE email = :email";
  	$query 	= $this->db->pdo->prepare($sql);
  	$query->bindValue(':email', $email);
  	$query->execute();
  	if ($query->rowCount() > 0) {
  		return true;
  	}else{
  		return false;
  	}
  }

/*  user profile data show*/
  public function getUserData(){
  	$sql 	= "SELECT * FROM user_tbl ORDER BY id DESC";
  	$query 	= $this->db->pdo->prepare($sql);
  	$query->execute();
  	$result = $query->fetchAll();
  	return $result;
  }

  public function getUserById($id){
  	$sql 	= "SELECT * FROM user_tbl WHERE id = :id LIMIT 1";
  	$query 	= $this->db->pdo->prepare($sql);
  	$query->bindValue(':id', $id);
  	$query->execute();
  	$result = $query->fetch(PDO::FETCH_OBJ);
  	return $result;
  }

/*  update user data form profile*/

  public function userdataupdate($id, $data){

  	$name 		= $data['name'];
  	$username 	= $data['username'];
  	$email 		= $data['email'];

  	//$chk_email 	= $this->emailCheck($email);


/*validation input data by update form profile*/
  	

  	if ($name == '' or $username == '' or $email == '' ) {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  Field must not be Empty</div>';
  		return $msg;
  	}
  	if (strlen($username) < 3) {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  User Name Too Short </div>';
  		return $msg;
  	}elseif (preg_match('/[^a-z0-9_-]+/i',$username)) {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  Username must only contain alphanumerical, dashes and underscore!</div>';
  		return $msg;
  	}
  	if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  Email addres not valide! Give valid email address</div>';
  		return $msg;
  	}/*
  	if ($chk_email == true) {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  Email addres exist!</div>';
  		return $msg;
  	}*/
  		/*insert data in database*/
  	$sql 	= "UPDATE user_tbl set name = :name, username = :username,email = :email WHERE id =:id";
  	$query 	= $this->db->pdo->prepare($sql);
  	$query->bindValue(':name', $name);
  	$query->bindValue(':username', $username);
  	$query->bindValue(':email', $email);
  	$query->bindValue(':id', $id);
  	$succregi = $query->execute();
  	if ($succregi) {
  		$msg = '<div class="alert alert-success" role="alert">Success!!  You have Successfull Update Thank you!</div>';
  		return $msg;
  	}else{
  		$msg = '<div class="alert alert-success" role="alert">Error!!  Plase try agane sonthing was wrong Thank you!</div>';
  		return $msg;

  	}
  }



  /*  if password exist for registration system*/
  public function passwordChech($id, $old_pass){
  	$password = $old_pass;
  	$sql 	= "SELECT password FROM user_tbl WHERE id =:id AND  password = :password";
  	$query 	= $this->db->pdo->prepare($sql);
  	$query->bindValue(':id', $id);
  	$query->bindValue(':password', $password);
  	$query->execute();
  	if ($query->rowCount() > 0) {
  		return true;
  	}else{
  		return false;
  	}
  }

  /*update password mecanism*/

  public function updatePassword($id, $data){
  	$old_pass = $data['oldpass'];
  	$new_pass = $data['newpass'];


  	$chk_pass = $this->passwordChech($id, $old_pass);

  	if ( $new_pass == '' or $old_pass == '') {
  		$msg = '<div class="alert alert-danger" role="alert">Field must not be Empty</div>';
  		return $msg;
	}
	if (strlen($new_pass) < 6) {$msg = '<div class="alert alert-danger" role="alert">Error!! Password Too Short.give above 6 alphabet</div>';
  		return $msg;
  	}
  	if ($chk_pass == false) {
  		$msg = '<div class="alert alert-danger" role="alert">Error!!  password not exist!</div>';
  		return $msg;
  	}

  	/*insert data in database*/

  	$password = $new_pass;
  	$sql 	= "UPDATE user_tbl set password = :password WHERE id =:id";
  	$query 	= $this->db->pdo->prepare($sql);
  	$query->bindValue(':password', $password);
  	$query->bindValue(':id', $id);
  	$succregi = $query->execute();
  	if ($succregi) {
  		$msg = '<div class="alert alert-success" role="alert">Success!!  Password Successfull Update Thank you!</div>';
  		return $msg;
  	}else{
  		$msg = '<div class="alert alert-success" role="alert">Error!!  Plase try agane sonthing was wrong Thank you!</div>';
  		return $msg;

  	}



  }

  
}