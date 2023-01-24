<div class="col-lg-4 col-md-4 col-sm-4">
        <div class="latest_post">
          <h2><span>Polular post</span></h2>
          <div class="latest_post_container" style="height:500p; overflow: auto;">
            <ul class="latest_postnav" >

            <!-- ADDING LATEST NEWS---------------------------------------------------------------------- -->
            <?php 

            $latest = "SELECT * FROM post_description ORDER BY RAND() DESC LIMIT 10";
            $latest_n = mysqli_query($conn , $latest);
            if($latest_n){
              while( $rows = mysqli_fetch_assoc($latest_n) ){
                $heading = $rows["p_heading"];
                $img = $rows["p_thumbnail"];
                $id = $rows["p_id"]
                ?>
                <li>
                <div class="media"> <a href="read-post.php?id=<?php echo $id; ?>" class="media-left"> <img alt="" src="./admin/upload/thumbnail/<?php echo $img; ?>"> </a>
                  <div class="media-body"> <a href="read-post.php?id=<?php echo $id; ?>" class="catg_title"> <?php echo $heading; ?> </a> </div>
                </div>
              </li>
              <?php

              }
            }
            ?>
            </ul>
          </div>
        </div>

        <aside class="right_content">
        <div class="latest_post">
            <h2><span>Latest Post</span></h2>
            <div class="latest_post_container" style="height:500p; overflow: auto;">
            <ul class="spost_nav pt-4"  >

            <!-- ADDING POPULAR NEWS --------------------------------------------------------------->
            <?php 
                $latest = "SELECT * FROM post_description ORDER BY p_time DESC LIMIT 10";
                $latest_n = mysqli_query($conn , $latest);
                if($latest_n){
                 
                  while( $rows = mysqli_fetch_assoc($latest_n) ){
                    $heading = $rows["p_heading"];
                    $img = $rows["p_thumbnail"];
                    $id = $rows["p_id"];
                    ?>
                    <li>
                    <div class="media"> <a href="read-post.php?id=<?php echo $id; ?>" class="media-left"> <img alt="" src="./admin/upload/thumbnail/<?php echo $img; ?>"> </a>
                      <div class="media-body"> <a href="read-post.php?id=<?php echo $id; ?>" class="catg_title"> <?php echo $heading; ?> </a> </div>
                    </div>
                  </li>
                  <?php
                  }
                }
                ?>
            </ul>
          </div>
          </div>
          <div class="single_sidebar">
          <div class="latest_post">
            <h2><span>category</span></h2>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="category">
                <ul>
                <li class="cat-item">  <a href="all-posts.php">All</a>  </li>
                <!-- adding category----------------------------------------------------------------- -->
                    <?php 
                // require_once "./admin/include/connection.php";

                $get_category = "SELECT * FROM post_category";
                $result = mysqli_query($conn , $get_category);
                if($result){
                  while ( $rows =  mysqli_fetch_assoc($result) ){
                    $c_name = $rows["c_name"];
                    $post = $rows["no_of_post"];
              ?> 
                <li class="cat-item"><a href="read-category.php?category=<?php echo $c_name; ?> "><?php echo ucwords($c_name); ?> (<?php echo $post; ?>)</a></li>
                      <?php
                        }
                    }
                  ?>
                <!-- end of adding category---------------------------------------------------------  -->
                </ul>
              </div>
            </div>
          </div>
          <div class="single_sidebar wow fadeInDown">
            <h2><span>Links</span></h2>
            <ul>
            <!-- <li><a href="#">Log-in / Sign-Up</a></li> -->
            <li><a href="./about-us.php">About us</a></li>
              <li><a href="./contact-us.php">Contact Us</a></li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </section>
  
  <footer id="footer">
    <div class="footer_top">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="footer_widget wow fadeInDown">
            <h2>Important Links</h2>
            <ul class="tag_nav">
            <!-- <li><a href="#">Log-in / Sign-Up</a></li> -->
               <!-- adding category----------------------------------------------------------------- -->
               <?php 
                // require_once "connection.php";

                $get_category = "SELECT * FROM post_category";
                $result = mysqli_query($conn , $get_category);
                if($result){
                  while ( $rows =  mysqli_fetch_assoc($result) ){
                    $c_name = $rows["c_name"];
                   
              ?> 
                <li><a href="read-category.php?category=<?php echo $c_name; ?> "> <?php echo ucwords($c_name); ?> </a></li>
                      <?php
                        }
                    }
                  ?>
                <!-- end of adding category---------------------------------------------------------  -->
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="footer_widget wow fadeInRightBig">
          <?php 
                $get_details = "SELECT * FROM contact_us ORDER BY id DESC LIMIT 1";
                $get_details_result = mysqli_query($conn , $get_details);

                if($get_details_result){
                  while ($rows = mysqli_fetch_assoc($get_details_result) ){

                    $address = ucwords($rows["address"]);
                    $phn = $rows["phn"];
                    $email = ucfirst($rows["email"]);
                    $fax = $rows["fax"];
              ?>
             
            <h2>Contact</h2>
            <p>Contact Us any time. We're open for any suggestion or just to have a chat.</p>
            <address>
          
              <P> Address : <?php echo $address; ?></P>
              <P>  Phone: <a  style="color:rgb(218,218,218);" href="tel:<?php echo $phn ?>"> <?php echo $phn; ?> </a></P>
              <p>Email : <a style="color:rgb(218,218,218);" href = "mailto:<?php echo $email; ?>"> <?php echo $email; ?> </a> </p>
              <p>Fax : <a style="color:rgb(218,218,218);" href="fax:<?php echo $fax; ?>"> <?php echo $fax; ?> </a> </p>
            </address>

            <?php 
              }
            }
            ?>

          </div>
        </div>
      </div>
    </div>
    <div class="footer_bottom">
      <p class="copyright">Copyright &copy; <?php echo date("Y" , strtotime("now") ); ?> <a href="./index.php">BNMS</a></p>
      <p class="developer" style="color:white;">Developed By BNMS</p>
      <!-- Wpfreeware -->
    </div>
  </footer>
</div>
<script src="assets/js/jquery.min.js"></script> 
<script src="assets/js/wow.min.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/jquery.li-scroller.1.0.js"></script> 
<script src="assets/js/jquery.newsTicker.min.js"></script> 
<script src="assets/js/jquery.fancybox.pack.js"></script> 
<script src="assets/js/custom.js"></script>
</body>
</html>