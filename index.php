<?php 
include("path.php");
//include(ROOT_PATH . "/app/controllers/topics.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Font Awesome -->
  <link href="assets/fontawesome/css/all.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">
  
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="/assets/images/fav.png?v=<?php echo time(); ?>">

  <!-- Custome Styles -->
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">

  <title>Recipes</title>
</head>
<body>

<?php include(ROOT_PATH . "/app/includes/header.php") ?>
<?php include(ROOT_PATH . "/app/includes/main-heading.php") ?>
<?php include(ROOT_PATH . "/app/includes/messages.php"); ?>



  <!-- Page Wrapper -->
  <div class="page-wrapper">

    <!-- Post Slider -->
    <!-- <div class="post-slider">
      <i class="fas fa-chevron-left prev"></i>
      <i class="fas fa-chevron-right next"></i>

      <div class="post-wrapper">

        <?php 
        // foreach ($posts as $post): ?>
          <div class="post">
            <div class="post-info">
              <h4><a href="single.php?id=<?php 
              // echo $post['id']; ?>"><?
              // php echo $post['title']; ?></a></h4>
              <i class="far fa-user"> <?
              // php echo $post['username']; ?></i>
              &nbsp;
              <i class="far fa-calendar"> <?php 
              // echo date('F j, Y', strtotime($post['created_at'])); ?></i>
            </div>
          </div>
        <?php 
      // endforeach; ?>


      </div>

    </div> -->
    <!-- // Post Slider -->

    <!-- Content -->
    <div class="content clearfix">

      <!-- Main Content -->
      <div class="main-content">
        <h1 class="recent-post-title"><?php echo $postsTitle ?></h1>

        <?php foreach ($posts as $post): ?>
          <div class="post clearfix">
            <div class="post-preview">
              <h2><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
              <i class="far fa-user"> <?php echo $post['username']; ?></i>
              &nbsp;
              <i class="far fa-calendar"> <?php echo date('F j, Y', strtotime($post['created_at'])); ?></i>
              <p class="preview-text">
                <?php echo html_entity_decode(substr($post['body'], 0, 150) . '...'); ?>
              </p>
              <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more">Read More</a>
            </div>
          </div>    
        <?php endforeach; ?>
        


      </div>
      <!-- // Main Content -->

      <div class="sidebar">

        <div class="section search">
          <h2 class="section-title">Search</h2>
          <form action="index.php" method="post">
            <input type="text" name="search-term" class="text-input" placeholder="Search...">
          </form>
        </div>


        <div class="section topics">
          <h2 class="section-title">Topics</h2>
          <ul>
            <?php foreach ($topics as $key => $topic): ?>
              <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

      </div>

    </div>
    <!-- // Content -->

  </div>
  <!-- // Page Wrapper -->