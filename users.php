<!-- Shows a list of users and their emails. -->
<?php
include('config.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
		<title>List of users</title>
	</head>
	<body>
		<div class="header">
			<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/background.gif" alt="Private Messaging System" /></a>
		</div>
		<div class="content">
<strong><mark>THE LIST OF ALL MEMBERS:</mark></strong>
			<table>
				<tr>
					
					<th style="color:red" class="center"><strong>Username</strong></th>
					
				</tr>

<?php
//We get the IDs, usernames and emails of users
$req = mysqli_query($link, 'select id, username, email from users');
while ($dnn = mysqli_fetch_array($req)) {
?>

				<tr>
					
					<td class="center"><a href="profile.php?id=<?php echo $dnn['id']; ?>"><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
					
				</tr>

<?php
}
?>
			</table>
		</div>
		<div class="foot"><a href="<?php echo $url_home; ?>"><strong>Home</strong></a></div>
	</body>
</html>
