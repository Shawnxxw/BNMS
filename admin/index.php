<?php 
    require_once "include/header.php";
?>

<?php
//  database connection
require_once "include/connection.php";

// total no of post
$select_total_post = "SELECT * FROM post_description WHERE p_time IS NOT NULL";
$total_post_result  = mysqli_query($conn , $select_total_post);


// selecting category details
$sql = "SELECT * FROM post_category";
$result = mysqli_query($conn , $sql);
$i = 1;


// selecting about us
$about_us = "";
$get_about = "SELECT * FROM about_us ORDER BY id DESC LIMIT 1";
$get_about_result = mysqli_query($conn , $get_about);

if($get_about_result){

    while($about_row = mysqli_fetch_assoc($get_about_result)){
       $about_us = $about_row["about"];
    } 
}


// selecting contact details
$phn_no = $email = $fax_no = $address = "";
$get_contact = "SELECT * FROM contact_us ORDER BY id DESC LIMIT 1";
$get_contact_result = mysqli_query($conn , $get_contact);

if($get_contact_result){

    while($contact_row = mysqli_fetch_assoc($get_contact_result)){
        $phn_no = $contact_row["phn"];
        $email = $contact_row["email"];
        $fax_no = $contact_row["fax"];
        $address = $contact_row["address"];
    } 
}

?>

<style>
table, th, td {
  border: 1px solid black;
  padding: 5px;
}
table {
  border-spacing: 10px;
}
</style>

<div class="container mb-5">
    <div class="row mt-5">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card shadow " >
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Post Categories</li>
                    <li class="list-group-item">Total Category: <span class="text-center"> <?php echo mysqli_num_rows($result); ?> </span> </li>
                    <li class="list-group-item text-center"><a href="manage-category.php"><b>View All Categories</b></a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card shadow " >
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Category's Detail</li>
                    <li class="list-group-item">
                         <table style="width:100%" class="table-hover text-center ">
                             <tr class="bg-dark">
                                  <th>Category Name</th>
                                  <th>No. of Posts</th>
                             </tr>
                             <?php 
                                  if( mysqli_num_rows($result) > 0){
                                    while( $rows = mysqli_fetch_assoc($result) ){
                                         $c_name= $rows["c_name"];
                                         $no_of_post = $rows["no_of_post"];
                                          $c_id = $rows["c_id"];
                               ?>
                             <tr>
                                 <td> <?php echo ucwords($c_name) ; ?></td>
                                 <td><?php echo $no_of_post; ?></td>
                                <?php 
                                        $i++;
                                        }
                                    }else{
                                        echo "no category found";
                                    }
                                ?>        
                             </tr>
                             </table>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card shadow " >
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Post's Detail</li>
                    <li class="list-group-item text-left">Total Posts : <?php 
                        if($total_post_result){
                            echo mysqli_num_rows($total_post_result);
                        }
                    ?></li>
                    <li class="list-group-item text-center"><a href="manage-post-desc.php"><b>View All Posts</b></a>   </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- 2nd row start -->
    <div class="row mt-5">
        <div class="col-lg-6 col-md-6 col-sm-12 "> 
        <div class="card shadow " >
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center"> <b>Contact Details </b> </li>
                    <li class="list-group-item"><b>  Address : </b>  <?php echo $address; ?> </li>
                    <li class="list-group-item"><b> Phone No. :  </b>   <?php echo $phn_no; ?> </li>
                    <li class="list-group-item"><b>  Email : </b>   <?php echo $email; ?></li>
                    <li class="list-group-item"><b> Fax No. :   </b> <?php echo $fax_no; ?></li>
                    <li class="list-group-item text-center"> <a href="contact-us.php"><b>Edit Contact Details</b> </a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 "> 
           <div class="card shadow">
                 <ul class="list-group list-group-flush">
                 <li class="list-group-item text-center"> <b>Location </b> </li>
                 <li class="list-group-item"> <iframe src="https://www.google.com/maps?q=<?php echo $address; ?>&output=embed" style=" height:230px; width:100%;" allowfullscreen="" loading="lazy"></iframe>
                    </li>
                </ul>
           </div>
        </div>
    </div>
    <!-- 3rd row start -->
    <div class="row mt-5 bg-white shadow">
        <div class="col-lg-3 col-md-9 col-sm-12 "> 
        <div class="" >
                <ul class="list-group list-group-flush pt-5 ">
                <li class="list-group-item text-center" style="font-size:29px;"> <b>About Us: </b> </li>
                <li class="list-group-item text-center"> <a class="btn btn-outline-primary" href="about-us.php"><b>Edit About Us </b> </a> </li>

                </ul>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 "> 
           <div class=" pt-5">
                <ul>
                   <li> <?php echo $about_us;?> </li>
                </ul>
           </div>
        </div>
    </div>
</div>



<?php 
    require_once "include/footer.php";
?>