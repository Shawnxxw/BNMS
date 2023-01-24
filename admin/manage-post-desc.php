<?php 
    require_once "include/header.php";
?>

<?php 
 
//  database connection
require_once "include/connection.php";

$sql = "SELECT * FROM post_description ORDER BY p_id DESC ";
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
    <div class="py-4 mt-5"> 
    <div class='text-center pb-2'><h4>Manage Post Description</h4></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>Post Heading</th>
        <th>Post Description</th>
        <th>Post Thumbnail</th>
        <th>Action</th>
    </tr>
    <?php 
    
    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $p_heading= $rows["p_heading"];
            $p_description = $rows["p_description"];
            $p_thumbnail = $rows["p_thumbnail"];
            $p_id = $rows["p_id"];
            $p_cat = $rows["p_category"];
            ?>
        <tr>
        <td><?php echo "{$i}."; ?></td>
        <td> <?php echo ucwords($p_heading) ; ?></td>
        <td><?php echo $p_description; ?></td>
        <td> <img src="upload/thumbnail/<?php echo $p_thumbnail;?> " class="img-fluid" style="height:70px"> </td>

        <td>   <?php
                $edit_icon = "<a href='edit-post-desc.php?id={$p_id}' class='btn-sm btn-primary float-right '> <span ><i class='fa fa-edit '></i></span> </a>";
                $delete_icon = " <a href='delete-post.php?id={$p_id}&category={$p_cat}' id='bin' class='btn-sm btn-danger float-right ml-3 '> <span ><i class='fa fa-trash '></i></span> </a>";
                echo   $delete_icon . $edit_icon;
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