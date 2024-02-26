<?php
session_start();

include 'Connector.php';



if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['loggedin'] == true){

  //Take the data from form-javascript
  $username = $_POST['username'];
  $pass= $_POST['password'];
  $old_pass= $_POST['old_password'];

  //Take the user id
  $client_id = $_SESSION['client_id'];

  //chek
  $check = mysqli_query($db,"SELECT Userspwd,UsersId,Usersusername from users WHERE UsersId='$client_id'");

  if(mysqli_num_rows($check)>0){
    while($row = mysqli_fetch_assoc($check)){
      $pass = $row['Userspwd'];
      $check_id = $row['UsersId'];
      $user_check = $row['Usersusername'];
	   mysqli_query($db,"UPDATE users SET Usersusername = '$username', Userspwd='$pass' WHERE UsersId = '$client_id'");
	   echo 1;
    }
  }

  //When user changes username
  if(mysqli_num_rows($user_check)==0){
    if(password_verify($old_pass,$pass)){//Change user and pass
      $pwd = password_hash($pass,PASSWORD_DEFAULT);
      mysqli_query($db,"UPDATE users SET Usersusername = '$username', Userspwd='$pwd' WHERE UsersId = '$client_id'");
      echo 1;
    } else{//Wrong pass
      echo 2;
    }
  } //when user is just changing password
  elseif(mysqli_num_rows($user_check)!==0 && $client_id == $check_id){//Same user change pss
    $pwd = password_hash($password,PASSWORD_DEFAULT);
    mysqli_query($db,"UPDATE users SET Userspwd = '$pwd' WHERE UsersId = '$client_id'");
    echo 1;
  }else{//Put another username
    echo 3;
  }
}




?>
