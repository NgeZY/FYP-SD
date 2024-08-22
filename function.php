<?php
function changePassword($user){
	$username = $_POST['username']
	$OPassword = $_POST['current_password'];
	$NPassword = $_POST['new_password'];
	$NPassword2 = $_POST['password_confirm'];
	$con = mysqli_connect("localhost", "root", "", "utmadvance");
	$qry = "SELECT Password FROM $user WHERE Username = '$username'";
	
    $result = mysqli_query($con, $qry);
        if(!$result){
			echo "The username you entered does not exist";
        } else if($password != mysql_result($result, 0)){
			echo "You entered an incorrect password";
        } else {
			if($NPassword == $NPassword2)
			$sql = mysql_query("UPDATE user_info SET password='$NPassword' where username='$username'");
	
			if($sql)
				echo "Password changed";
			else
				echo "Password do not match";
		}
}
?>