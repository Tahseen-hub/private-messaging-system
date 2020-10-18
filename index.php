<!-- Home page. App starts here. -->
<?php
include('config.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Private Messaging System</title>
    </head>
    <body>
	
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/background.gif" alt="Private Messaging System" /></a>
	    
		</div>
        <div class="content">
<?php
//We display a welcome message, if the user is logged, we display it username
?>

<p align="center" style="font-size:1.5em"; >
<strong>Hello!!</strong>
<?php
if(isset($_SESSION['username'])) {
	echo ' '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');}
?>

		<br />
<strong> Welcome to PMS</strong> <br /> <br>
</p>
<?php
//If the user is logged, we display links to edit his infos, to see his pms and to log out
if (isset($_SESSION['username'])) {
	
	//We count the number of new messages the user has
	$nb_new_pm = mysqli_fetch_array(mysqli_query($link, 'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
	//The number of new messages is in the variable $nb_new_pm
	$nb_new_pm = $nb_new_pm['nb_new_pm'];
	//We display the links
?>

<a href="list_pm.php" style ="color: #1912e1; font-weight: bold"><u> My Personal Messages </u>>  (<?php echo $nb_new_pm; ?> unread)</a><br />
<br><a href="connection.php"><strong>Logout</strong></a>
<?php
}
else {
//Otherwise, we display a link to log in and to Register
?>
<a href="Register.php"><strong>Register Now</strong></a><br />
<br>
<a href="connection.php"><strong>Log in</strong></a>
<?php
}
?>
		</div>
	</body>
</html>