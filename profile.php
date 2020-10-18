<?php
include('config.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
		<title>Profile of an user</title>
	</head>
	<body>
		<div class="header">
			<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/background.gif" alt="Private Messaging System" /></a>
		</div>
		<div class="content">

<?php
//We check if the users ID is defined
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	//We check if the user exists
	$dn = mysqli_query($link, 'select username, email, signup_date from users where id="'.$id.'"');
	if (mysqli_num_rows($dn)>0) {
		$dnn = mysqli_fetch_array($dn);
		//We display the user data
?>
This is the profile of "<?php echo htmlentities($dnn['username']); ?>" :
	<table style="width:500px;">
		<tr>
			<td>
<?php
		/*if ($dnn['avatar'] != '') echo '<img src="'.htmlentities($dnn['avatar'], ENT_QUOTES, 'UTF-8').'" alt="Avatar" style="max-width:100px;max-height:100px;" />';
		else echo "This user doesn't have an Nickname.";*/
?>
			</td>
			<td class="left"><h1><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></h1>
			<p align="center">Email: <?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?><br /> </p>
			</td>

		</tr>
	</table>
<?php
//We add a link to send a pm to the user
		if (isset($_SESSION['username']))
?>
<br /><a href="new_pm.php?recip=<?php echo urlencode($dnn['username']); ?>" class="big"> Send a PM to "<?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?>"</a>
<?php
	}
	else echo "This user doesn't exists";
}
else echo 'The user ID is not defined';
?>
		</div>
		<div class="foot"><a href="users.php"><strong> Back to the LIST OF MEMBERS </strong></a></div>
	</body>
</html>