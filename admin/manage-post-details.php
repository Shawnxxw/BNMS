<?php 
    require_once "include/header.php";
?>

<?php 
 
//  database connection
require_once "include/connection.php";

$sql = "SELECT * FROM post_description ORDER BY p_time DESC";
$result = mysqli_query($conn , $sql);

$i = 1;

?>

<style>
table, th, td {
  border: 1px solid black;
  padding: 15px;
}
table {
  border-spacing: 10px;
}
</style>

<div class="container bg-white shadow mb-5">
    <div class="py-4 mt-3"> 
    <div class='text-center pb-2'><h4>Manage Post Details</h4></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>Post Heading</th>
        <th>Post Details</th>
        <th>Post Image</th>
        <th>Action</th>
    </tr>
    <?php 
    
    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $p_heading= $rows["p_heading"];
            $complete_post = $rows["complete_post"];
            $p_carousel = $rows["p_carousel"];  
            $id = $rows["p_id"];     
            ?>
        <tr>
        <td><?php echo "{$i}."; ?></td>
        <td> <?php echo ucwords($p_heading) ; ?></td>
        <td><?php 
            if( strlen($complete_post) < 100){
                echo $complete_post;
            }else{
                $add_3_dots = "...";
                $complete_post = substr($complete_post , 0 , 200); 
                echo $complete_post, $add_3_dots ;
            }
        ?></td>
        <td> <img src="upload/carousel/<?php echo $p_carousel;?> " class="img-fluid" style="height:70px"> </td>

        <td> <?php
                $edit_icon = "<a href='edit-post-details.php?id={$id}' class='btn-sm btn-primary float-right '> <span ><i class='fa fa-edit '></i></span> </a>";
                echo $edit_icon;
             ?> 
        </td>   

    <?php 
            $i++;
            }
        }else{
        echo "no category found";
        }
    ?>
     </tr>
    </table>
    </div>
</div>

<?php 
    require_once "include/footer.php";
?>