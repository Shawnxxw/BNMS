<!DOCTYPE html>
<html>
<head>
<title>Breaking News</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="assets/css/font.css">
<link rel="stylesheet" type="text/css" href="assets/css/li-scroller.css">
<link rel="stylesheet" type="text/css" href="assets/css/slick.css">
<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
  <div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
  <header id="header">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_top">
          <div class="header_top_left">
            <ul class="top_nav ">
              <li><a href="./index.php">Home</a></li>
              <li><a href="./about-us.php">About us</a></li>
              <li><a href="./contact-us.php">Contact Us</a></li>
            </ul>
          </div>
          <div class="header_top_right">
            <p> <?php echo date("l, F d, Y" , strtotime("now") ); ?> </p>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_bottom ">
          <div class="logo_area"><a href="index.php" class="logo"><img src="images/logo.jpg" alt=""></a></div>
        </div>
      </div>
    </div>
  </header>
  <section id="navArea">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav main_nav">
          <li class="active"><a href="./index.php"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
         <li> <a href="all-posts.php">All</a>  </li>
         <!-- category------------------------------------------------------------------------- -->
         <?php 
            require_once "./admin/include/connection.php";

            $get_category = "SELECT * FROM post_category";
            $result = mysqli_query($conn , $get_category);
            if($result){
              while ( $rows =  mysqli_fetch_assoc($result) ){
                $c_name = $rows["c_name"]
          ?> 
            <li><a href="read-category.php?category=<?php echo $c_name; ?> "><?php echo $c_name; ?></a></li>
    <?php
          }
       }
    ?>
         
        </ul>
      </div>
    </nav>
  </section>
  <section id="newsSection">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="latest_newsarea"> <span>Latest News</span>
          <ul id="ticker01" class="news_sticker">
          <!-- latest news------------------------------------------------------------ -->
            <?php 
            
            $latest = "SELECT * FROM post_description ORDER BY p_time DESC";
            $latest_n = mysqli_query($conn , $latest);
            if($latest_n){
              $i = 1;
              while( $rows = mysqli_fetch_assoc($latest_n) ){
                $heading = $rows["p_heading"];
                $img = $rows["p_thumbnail"];
                $id = $rows["p_id"];
              
                ?>
               <li><a href='read-post.php?id=<?php echo $id; ?>'><img   src="./admin/upload/thumbnail/<?php echo $img; ?>"> <?php echo $heading ?> </a></li>
                <?php
                if( $i > 4 ){
                  break;
                }
                $i++;

              }
            }
            ?>
        </div>
      </div>
    </div>
  </section>
 

      
