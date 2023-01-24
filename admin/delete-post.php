<?php 

require_once "include/connection.php";

    $p_id = $_GET["id"]; 
    $p_cat = $_GET["category"];


        $select_no_of_post_per_cat = "SELECT * FROM post_category WHERE c_name  = '$p_cat' ";
        $result_post = mysqli_query($conn , $select_no_of_post_per_cat);

        if($result_post){
            while( $rows = mysqli_fetch_assoc($result_post) ){
                $no_of_post = $rows["no_of_post"];
                $no_of_post -= 1;
            }
            // update no of post in post_category
            $update = "UPDATE post_category SET no_of_post = '$no_of_post' WHERE c_name = '$p_cat' ";
            $result_update = mysqli_query( $conn , $update);
        }

        $delete_cat = "DELETE FROM post_description WHERE p_id = '$p_id' ";
        $result = mysqli_query($conn , $delete_cat);
        if($result ){
            header("Location: manage-post-desc.php?delete-success");
        }


?>