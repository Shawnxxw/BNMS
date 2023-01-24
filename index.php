<?php 
    require_once "include/header.php";
?>

<section id="sliderSection">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="slick_slider">

        <!-- adding carousel -------------------------------------------------------------------------->
        <?php 
            
            $latest = "SELECT * FROM post_description ORDER BY p_time DESC LIMIT 5";
            $latest_n = mysqli_query($conn , $latest);
            if($latest_n){
              while( $rows = mysqli_fetch_assoc($latest_n) ){
                $heading = $rows["p_heading"];
                $img = $rows["p_carousel"];
                $description = $rows["p_description"];
                $news_id = $rows["p_id"];
                ?>
                 <div class="single_iteam"> <a href="read-post.php?id=<?php echo $news_id ?>"> <img src="admin/upload/carousel/<?php echo $img; ?>" ></a>
                  <div class="slider_article">
                    <h2><a class="slider_tittle" href="read-post.php?id=<?php echo $news_id ?>"><?php echo $heading; ?></a></h2>
                    <p> <?php echo $description; ?> </p>
                  </div>
             </div>
                <?php
              
              }
            }
            ?>
  <!-- end carousel----------------------------------------------------------------------------------------- -->
        </div>
      </div>
    </div>
</section>
<section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="single_post_content">
           <?php

              // selecting category Name-----------------------------------------------
            $select_cat = "SELECT * FROM post_category";
            $result = mysqli_query($conn , $select_cat);

            if($result){
              while( $rows = mysqli_fetch_assoc($result) ){
                $cat_name =  $rows["c_name"];
            echo   "<h2><span> $cat_name </span></h2>";

            // selecting category latest 1 news-------------------------------------------------
             if($cat_name ){

              $select_news = "SELECT * FROM post_description WHERE p_category = '$cat_name' ORDER BY p_time DESC  LIMIT 1 ";
              $result_news = mysqli_query( $conn , $select_news );
              if( $result_news ){
                $n = 0;
                  while( $rows_news= mysqli_fetch_assoc($result_news) ){
                    $news_thumb = $rows_news["p_thumbnail"];
                    $news_heading = $rows_news["p_heading"];
                   $news_description = $rows_news["p_description"];
                  $id_n = $rows_news["p_id"];
                 ?>

                    <!-- Display big news left side -->
                <div class="row">  
                    <div class="col-lg-6 col-md-6 col-sm-12">      
                        <ul class="wow fadeInDown">
                            <li>
                            <a href="read-post.php?id=<?php echo $id_n ?>" > <img alt="" style="height:300px; " class="img-fluid img-responsive" src="admin/upload/thumbnail/<?php echo $news_thumb; ?>"> </a>
                                <div> <a href="read-post.php?id=<?php echo $id_n ?>" > <h3> <?php echo ucwords($news_heading); ?> </h3> </a> </div>
                                <div> <a href="read-post.php?id=<?php echo $id_n ?>" > <?php echo ucwords($news_description); ?>  </a> </div>        
                            </li>
                        </ul>      
                    </div>
                    <?php 
                        }
                    }

                    $select_small_news =  "SELECT * FROM post_description WHERE p_category = '$cat_name' ORDER BY p_time DESC  LIMIT 5 OFFSET 1  ";
                    $small_news_result = mysqli_query($conn , $select_small_news);
                    if( $small_news_result ){
                        while( $small_rows = mysqli_fetch_assoc($small_news_result) ){
                            $small_headline = $small_rows["p_heading"];
                            $small_thumb = $small_rows["p_thumbnail"];
                            $id_n = $small_rows["p_id"];
                            $small_cat = $small_rows["p_category"];
                           ?>
                           
                           <!-- adding 5 small news right side -->

                           <div  class=" d-flex flex-row justify-content-start"> 
                         <div class=" col-lg-2 col-md-2 col-sm-6">  
                            <ul class="wow fadeInDown">
                             <li>
                                  <div> <a href="read-post.php?id=<?php echo $id_n ?>" > <img style="height:60px;" class="img-fluid img-responsive" src="admin/upload/thumbnail/<?php echo $small_thumb; ?>"> </a>
                                  </div>
                             </li>
                           </ul>
                         </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <ul class="wow fadeInDown">
                              <li>
                                  <div> <a href="read-post.php?id=<?php echo $id_n ?>" > <?php echo ucwords($small_headline); ?>  </a> </div>
                                  <br>
                              </li>
                             </ul>
                        </div>
                        &nbsp;
                    </div>
                            <?php 
                        }
                    }
                    ?>

                    </div>
                      <!-- see more -->
                    <div style="position: relative;"> 
                        <a href="read-category.php?category=<?php echo$cat_name; ?>" style="position: absolute; bottom: 8px; right: 16px; color:blue;">see more...</a> 
                    </div>
                    <!-- end see more -->
                 <?php
             }
          }
        }
      ?>

          </div> 
        </div> 
    </div>



<?php 
  require_once "include/footer.php";
?>