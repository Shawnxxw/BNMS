<?php
    require_once "include/header.php";
?>



<section id="contentSection">
    <div class="row">

        <div class="col-12">
         <div class="left_content">
          <div class="contact_area">
            <h2> Visit us anytime </h2>
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
            <iframe src="https://www.google.com/maps?q=<?php echo $address; ?>&output=embed" style="border:3; height:400px; width:100%;" allowfullscreen="" loading="lazy"></iframe>
           </div>
        </div>
        </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="left_content">
          <div class="contact_area">
            <h2>Contact Us</h2>
            <h4 class="text-center">We're open for any suggestion or just to have a chat</h4>
            <form action="#" class="contact_form">
              <input class="form-control" type="text" placeholder="Name*">
              <input class="form-control" type="email" placeholder="Email*">
              <textarea class="form-control" cols="30" style="resize: none;" rows="10" placeholder="Message*"></textarea>
              <input type="submit" value="Send Message">
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="right_content" style=" position: relative;">
            <div class="contact_area" style="font-size:20px;" >

              <h2>Get In Touch</h2>

              <p ><i style="font-size:29px;" class="fa fa-map-marker" aria-hidden="true"></i>
                &nbsp;&nbsp;  
                Address: <span style="text-align: justify; width: 100px;"> <?php echo $address; ?> </span>
               </p>

              <p><i style="font-size:29px;" class="fa fa-phone" aria-hidden="true"></i> 
                &nbsp;&nbsp; Phone: <a href="tel:<?php echo $phn ?>"> <?php echo $phn; ?> </a> </p>

                
                <p ><i style="font-size:29px;" class="fa fa-location-arrow fa-10x" aria-hidden="true"></i>
                &nbsp; &nbsp; Email: <a href = "mailto:<?php echo $email; ?>"> <?php echo $email; ?> </a></p>
                
                <p><i class="fa fa-fax" aria-hidden="true"></i>
                &nbsp;&nbsp; Fax: <a href="fax:<?php echo $fax; ?>"> <?php echo $fax; ?> </a>
              </p>

              <?php
                  }
                }
            ?>
            </div>
          </div>
      </div>
      <!-- closing row -->
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
               
                $get_category = "SELECT * FROM post_category";
                $result = mysqli_query($conn , $get_category);
                if($result){
                  while ( $rows =  mysqli_fetch_assoc($result) ){
                    $c_name = $rows["c_name"]
              ?> 
                <li><a href="read-category.php?category=<?php echo $c_name; ?> "> <?php echo ucwords($c_name); ?></a></li>
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