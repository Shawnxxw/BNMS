<?php 
    require_once "include/header.php";
?>
<?php

            // databse connection
            require_once "include/connection.php";

            $get_existing_about = "SELECT * FROM about_us ORDER BY id DESC LIMIT 1";
            $existing_about_result = mysqli_query($conn , $get_existing_about);

            if($existing_about_result){
                while($existing_about = mysqli_fetch_assoc($existing_about_result)){
                    $about = $existing_about["about"];
                }
            }

    $about_err ="";
    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
       
        if( empty($_REQUEST["about"]) ){
            $about_err = "<p style='color:red'>* About can not be empty</p>";
            $about = "";
        }else{
            $about = $_REQUEST["about"];

            $insert_about = "INSERT INTO about_us(about) VALUES('$about')";
            $insert_about_result = mysqli_query($conn , $insert_about);

            if($insert_about_result){
                echo "<script>
                $(document).ready( function(){
                    $('#showModal').modal('show');
                    $('#linkBtn').hide();
                    $('#addMsg').text('About Us Section Updated Successfully!');
                    $('#closeBtn').text('OK');
                })
             </script>
             ";
            }
        }

        
    }


?>
<!-- ckeditor js -->
<script src="include/ckeditor/ckeditor.js"></script>

<div class="container mb-5">
    <div id="form" class="pt-5 form-input-content">
        <div class="card login-form mb-0">
            <div class="card-body pt-3 shadow">
                <h4 class="text-center">Add About Us Section </h4>
                <form method="POST" enctype="multipart/form-data" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>"> 
                       
                    <div class="form-group">
                        <label> <h4 class="pt-4">About Us: </h4> </label>
                        <textarea name="about" id="about"> <?php echo $about; ?></textarea>    
                        <?php echo $about_err; ?>  
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" value="Add" class="btn login-form__btn submit w-10 " name="submit_expense" >
                    </div>
                </form>
            </div>
            <!-- ckeditor function call -->
            <script>
                CKEDITOR.replace('about');
            </script>
        </div>
    </div>
</div>



<?php
    require_once "include/footer.php";
?>