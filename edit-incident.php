<?php  
include("database/connection.php");
include("database/functions.php");

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');

$topics = getAllTopics();	
?>

	<title>Admin | Manage Topics</title>
</head>
<body>
	<!-- admin navbar -->
	<div class="container content">
		<!-- Left side menu -->

		<!-- Middle form - to create and edit -->
		<div class="action">
			<h1 class="page-title">Create/Edit Topics</h1>
			<form method="post" action="edit-incident.php" >
				<!-- validation errors for the form -->
				
				<!-- if editing topic, the id is required to identify that topic -->
				<?php if ($isEditingTopic === true): ?>
					<input type="hidden" name="topic_id" value="<?php echo "id"; ?>">
				<?php endif ?>
				<input type="text" name="topic_name" value="<?php echo "name"; ?>" placeholder="Topic">
				<!-- if editing topic, display the update button instead of create button -->
				<?php if ($isEditingTopic === true): ?> 
					<button type="submit" class="btn" name="update_topic">UPDATE</button>
				<?php else: ?>
					<button type="submit" class="btn" name="create_topic">Save Topic</button>
				<?php endif ?>
			</form>
		</div>
		<!-- // Middle form - to create and edit -->

</body>
</html>