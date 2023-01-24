<?php 
require_once "include/header.php";
?>

<?php

 $category = ucwords($_GET["category"]);
?>

<section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="single_post_content">
                <h2><span> <?php echo $category ?></span> </h2>

                <!-- adding all news of selected category -->
                <?php
                
                $select_cat_news = "SELECT * FROM post_description WHERE p_category = '$category' ORDER BY p_time DESC ";
                $result_cat_news = mysqli_query($conn , $select_cat_news);

                if($result_cat_news){
                    while ( $cat_news_rows = mysqli_fetch_assoc($result_cat_news) ){
                     $post_thumb = $cat_news_rows["p_thumbnail"];
                      $post_heading = $cat_news_rows["p_heading"];
                      $post_id = $cat_news_rows["p_id"];
                      $post_desc = $cat_news_rows["p_description"];
                      $post_id = $cat_news_rows["p_id"];
             ?>

                <!-- inner card row -->

               <div class="row">
                      <div class="card">
                        <div class="col-lg-4">
                            <a href="read-post.php?id=<?php echo $post_id; ?>" > <img  style="height:150px; width:100%; " class="card-img img-fluid img-responsive" src="admin/upload/thumbnail/<?php echo $post_thumb; ?>"> </a>
                        </div>
                          <div class="card-body">
                             <div class="card-text"> <a href="read-post.php?id=<?php echo $post_id; ?>" > <h3> <?php echo ucwords($post_heading); ?> </h3> </a> </div>
                             <div class="card-text"> <a href="read-post.php?id=<?php echo $post_id ?>" ><?php echo ucwords($post_desc); ?> </a> </div>
                        </div>
                    </div>
               </div>

                  <?php
                  }
                }
                        
                ?>
               <!-- inner row end -->
               
          </div>
        </div>
      </div>


<?php
require_once "include/footer.php";
?>