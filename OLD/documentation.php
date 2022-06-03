<?php include("path.php"); ?>
<?php include('app/database/functions.php'); 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Documentation</title>
  <meta name="viewport" content="width=device-width">
  
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="/assets/images/fav.png">

  <!-- Custome Styles -->
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
  integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">
</head>
<body>

<?php include(ROOT_PATH . "/app/includes/header.php") ?>
<?php include(ROOT_PATH . "/app/includes/main-heading.php") ?>

<div class="row">
      <div class="column">
      <a href="document-1.php" style="text-decoration:none;color:black;"><div class="box">
          <div class="top-bar"></div>
            <div class="content">
              <h3>Creating Domain/Subdomains on Cloudflare</h3>
              <p>Lorem ipsum..</p>
            </div>
        </div>
    </a>
      </div>
      <div class="column">
        <a href="testdocument.php" style="text-decoration:none;color:black;"><div class="box">
          <div class="top-bar"></div>
            <div class="content">
              <h3>Test Document</h3>
              <p>Here are the first few words of the document and hope that it fits and wraps the text..</p>
            </div>
        </div>
        </a>
      </div>
      <div class="column">
        <div class="box">
          <div class="top-bar"></div>
            <div class="content">
              <h3>My Work[Box 3]</h3>
              <p>Lorem ipsum..</p>
            </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="column">
        <div class="box">
          <div class="top-bar"></div>
            <div class="content">
              <h3>My Work[Box 4]</h3>
              <p>Lorem ipsum..</p>
            </div>
        </div>
      </div>
    </div>

    </div>
</body>
</html>