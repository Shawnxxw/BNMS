<?php 

require_once "include/header.php";
?>
 <?php  
    


    // databaseconnection
    require_once "include/connection.php";

    $sql_command = "SELECT * FROM admin WHERE email = '$_SESSION[email]' ";
    $result = mysqli_query($conn , $sql_command);

    if( mysqli_num_rows($result) > 0){
       while( $rows = mysqli_fetch_assoc($result) ){
           $name = ucwords($rows["name"]);
           $gender = ucwords($rows["gender"]);
            $photo = $rows["photo"];
       }

       if( empty($gender)){
           $gender = "Not Defined";
       }

}
 ?>


<div class=container>
    <div class="row ">
        <div class="col-4 ">
        </div>
        <div class="col-12 col-lg-6 col-md-6">
            <div class="card shadow" style="width: 20rem;">
            <img src="upload/photo/<?php if(!empty($photo)){ echo $photo; }else{ echo "1.jpg"; } ?>" class="rounded img-fluid  card-img-top"  style="height: 300px "  alt="...">
                <div class="card-body">
                <h2 class="text-center mb-4"><?php echo $name; ?> </h2>
                    <p class="card-text">Email: <?php echo $_SESSION["email"] ?> </p>
                    <p class="card-text">Gender: <?php echo $gender ?> </p>
                    <p class="text-center">
                    <a href="edit-profile.php" class="btn btn-outline-primary">Edit Profile</a>
                    <a href="change-pass.php" class="btn btn-outline-primary">Change Password</a>
                    <a href="change-photo.php" class="mt-2 btn btn-outline-primary">Change profile photo</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
require_once "include/footer.php";
?>