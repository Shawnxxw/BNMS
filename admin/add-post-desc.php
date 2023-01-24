
<?php 
    require_once "include/header.php";
?>
<?php

    // database connection
    require_once "include/connection.php";


    $category_err = $p_heading_err = $editor_err = $thumbnail_err=  "";
    $category = $p_heading = $editor =  $thumbnail_name = "";
    $t = 1;
    if( $_SERVER["REQUEST_METHOD"] == "POST" ){
        
        if( empty($_REQUEST["p_category"])){
            $category_err =  "<p style='color:red'> * Category is Required </p>";
        }else {
          $category = $_REQUEST["p_category"];
        }

        if( empty( $_REQUEST["p_heading"] ) ){
            $p_heading_err = "<p style='color:red'> * Post Heading is Required </p>";
        }else{
            $p_heading = $_REQUEST["p_heading"];
        }

        if( empty( $_REQUEST["editor"] ) ){
            $editor_err = "<p style='color:red'> * Post Description is Required </p>";
        }else{
           $editor = $_REQUEST["editor"];
        }

        if( empty($_FILES["thumbnail"]["name"])){
           $thumbnail_err = "<p style='color:red'> * Post Thumbnail is Required </p>";
        }else{

            $thumbnail_name = $_FILES["thumbnail"]["name"];
           $thumbnail_temp_loc = $_FILES["thumbnail"]["tmp_name"];

           $temp_extension = explode(".",$thumbnail_name);
          $thumbnail_extension = strtolower( end($temp_extension) );
          $isallowded = array("jpg","png","jpeg" );

          if( in_array( $thumbnail_extension , $isallowded ) ){
            $new_file_name =  uniqid("",true).".".$thumbnail_extension;      
          $location = "upload/thumbnail/".$new_file_name;  
          
          }else {
            $thumbnail_err = "<p style='color:red'> * Only JPG , JPEG and PNG files accepted </p>";
            $thumbnail_name ="";
          }
        }

        if( !empty($category) && !empty($editor) && !empty($p_heading) && !empty( $thumbnail_name ) ){
            move_uploaded_file($thumbnail_temp_loc,$location);

        $add_post_description = "INSERT INTO post_description( p_heading , p_description , p_thumbnail , p_category) VALUES ( '$p_heading' , '$editor' , '$new_file_name' , '$category')";
        $result_add_desc = mysqli_query($conn , $add_post_description);

        if($result_add_desc){
            $category = $p_heading = $editor = "";
            echo "<script>
            $(document).ready( function(){
                $('#showModal').modal('show');
                $('#linkBtn').attr('href', 'add-post-details.php');
                $('#linkBtn').text('Add Post Details');
                $('#addMsg').text('Post Heading Added Successfully!');
                $('#closeBtn').text('Add More');
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
                <h4 class="text-center">Add Post Description </h4>
                <form method="POST" enctype="multipart/form-data" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>"> 
                <div class="form-group">
                        <label >Select Post Category: </label>
                        <select name="p_category" class="form-control" >
                            <option value="">Please Select a Category: </option>
                            <?php    
                          
                            $get_category = "SELECT * FROM post_category";
                            $post_category = mysqli_query($conn , $get_category);

                            if(  mysqli_num_rows($post_category) > 0  ){
                                while( $rows = mysqli_fetch_assoc($post_category) ){
                                    $c_name = ucwords( $rows["c_name"] ) ;
                                    // echo " <option value='$c_name'  > $c_name </option> ";
                                    ?>
                                    <option value="<?php echo $c_name ?>" <?php if($c_name == $category){ echo 'selected';} ?> > <?php echo $c_name?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <?php echo $category_err; ?>
                    </div>           
                    <div class="form-group">
                        <label >Post Heading:</label>
                        <input type="text" class="form-control" value="<?php echo $p_heading; ?>" name="p_heading" > 
                        <?php echo $p_heading_err; ?>                
                    </div>
                    <div class="form-group">
                        <label> Add Small Description: </label>
                        <textarea name="editor" id="editor"  ><?php echo $editor; ?></textarea>
                        <?php echo $editor_err; ?>
                    </div>
                    <div class="form-group">
                        <label> Add Thumbnail: </label>
                        <input type="file" name="thumbnail" class="form-control"  >
                        <?php echo $thumbnail_err; ?>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Add" class="btn login-form__btn submit w-10 " name="submit_expense" >
                    </div>

                </form>
            </div>
            <!-- ckeditor function call -->
            <script>
                CKEDITOR.replace('editor');
            </script>
        </div>
    </div>
</div>




<?php 
    require_once "include/footer.php";
?>