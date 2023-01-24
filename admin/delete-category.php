<?php 

require_once "include/connection.php";

    $c_id = $_GET["id"]; 


        $delete_cat = "DELETE FROM post_category WHERE c_id = '$c_id' ";
        $result = mysqli_query($conn , $delete_cat);
        if($result ){
            header("Location: manage-category.php?delete-success");
        }


?>