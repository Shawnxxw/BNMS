
<?php 
    require_once "include/header.php";
?>
<?php

    // database connection
    require_once "include/connection.php";

    $id = $_GET["id"];
    $get_post_details = "SELECT * FROM post_description WHERE p_id ='$id' ";
    $result_get_post_details = mysqli_query($conn, $get_post_details);

    if($result_get_post_details){
       while ( $post_details_row = mysqli_fetch_assoc($result_get_post_details) ){
        $category = $post_details_row["p_category"];
        $p_heading = $post_details_row["p_heading"];
        $editor =  $post_details_row["p_description"];
       }
    }


    $category_err = $p_heading_err = $editor_err = $thumbnail_err=  $thumbnail_name = "";
   
    $t = 1;
    if( $_SERVER["REQUEST_METHOD"] == "POST" ){
        
        if( empty($_REQUEST["p_category"])){
            $category_err =  "<p style='color:red'> * Category is Required </p>";
            $category = "";
        }else {
          $category = $_REQUEST["p_category"];
        }

        if( empty( $_REQUEST["p_heading"] ) ){
            $p_heading_err = "<p style='color:red'> * Post Heading is Required </p>";
            $p_heading = "";
        }else{
            $p_heading = $_REQUEST["p_heading"];
        }

        if( empty( $_REQUEST["editor"] ) ){
            $editor_err = "<p style='color:red'> * Post Description is Required </p>";
            $editor = "";
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
          
          }else{
            $thumbnail_err = "<p style='color:red'> * Only JPG , JPEG and PNG files accepted </p>";
            $thumbnail_name ="";
          }
        }

        if( !empty($category) && !empty($editor) && !empty($p_heading) && !empty( $thumbnail_name) ){
            move_uploaded_file($thumbnail_temp_loc,$location);

             $update_post_description = "UPDATE post_description SET p_heading = '$p_heading' , p_description = '$editor' , p_thumbnail = '$new_file_name' , p_category = '$category' WHERE p_id = '$id' ";
              $result_update_desc = mysqli_query($conn , $update_post_description);

            if($result_update_desc){
                echo "<script>
                $(document).ready( function(){
                    $('#showModal').modal('show');
                    $('#linkBtn').attr('href', 'manage-post-desc.php');
                    $('#linkBtn').text('View All Posts');
                    $('#addMsg').text('Post Details Edited Successfully!');
                    $('#closeBtn').text('Edit Again');
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
                <h4 class="text-center">Edit Post Description </h4>
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