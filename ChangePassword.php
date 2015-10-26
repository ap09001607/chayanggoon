<?PHP
	session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "0023ac4D", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 
?>

ChangePassword form
<hr>

<?PHP

	if(isset($_POST['Change'])){
		$oldpassword = trim($_POST['Old_Password']);
		$newpassword = trim($_POST['New_Password']);
		$confirmpassword = trim($_POST['confirm']);
		if($newpassword==$confirmpassword && $newpassword!=null && $oldpassword =$_SESSION['PASSWORD']){
			$query = "UPDATE AA_LOGIN SET PASSWORD='$newpassword' WHERE Password = '$oldpassword'";
			$parseRequest = oci_parse($conn, $query);
			oci_execute($parseRequest);
			echo "success";
		}
	};
?>

<form action='ChangePassword.php' method='post'>
	Old_Password <br>
	<input name='Old_Password' type='password'><br>
	New_Password<br>
	<input name='New_Password' type='password'><br>
	confirm<br>
	<input name='confirm' type='password'><br><br>

	<input name='Change' type='submit' value='Change'>
	
</form>