<?php 
    require_once "include/header.php";
?>

<?php 
        
        require_once "include/connection.php";

        $get_existing_contact = "SELECT * FROM contact_us ORDER BY id DESC LIMIT 1";
        $existing_contact_result = mysqli_query($conn , $get_existing_contact);

        if($existing_contact_result){
            while($existing_contact = mysqli_fetch_assoc($existing_contact_result)){
                $address = $existing_contact["address"];
                $phn_no = $existing_contact["phn"];
                $email = $existing_contact["email"];
                $fax = $existing_contact["fax"]; 
            }
        }

        $address_err = $phn_no_err = $email_err =  $fax_err =  "";
        $phn_no_invalid = $email_invalid = $fax_invalid = "";
        
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // validate address
        if(empty($_REQUEST["address"])){
            $address_err =  "<p style='color:red'> * Address is Required </p>";
            $address = "";
        }else{
            $address = $_REQUEST["address"];
        }

        // validate phone number
        if( empty($_REQUEST["phn"]) ){
            $phn_no_err = "<p style='color:red'> * Phone Number is Required </p>";
            $phn_no = "";
        }elseif(preg_match('/[a-zA-Z]/', $_REQUEST["phn"] ) ){ 
            $phn_no_err = "<p style='color:red'> * Only Numbers Allowed</p>";
            $phn_no_invalid = $_REQUEST["phn"];
            $phn_no = "";
        }else{
            $phn_no = $_REQUEST["phn"];
        }

        // validate email
        if( empty($_REQUEST["email"])){
            $email_err = "<p style='color:red'> * Email is Required </p>";
            $email = "";
        }elseif( !preg_match('/[@]/' , $_REQUEST["email"]) ){
            $email_err = "<p style='color:red'> * Email is Invalid </p>";
            $email_invalid = $_REQUEST["email"];
            $email = "";
        }else {
            $email = $_REQUEST["email"];
        }

        // validate fax    
        if( empty($_REQUEST["fax"]) ){
            $fax_err = "<p style='color:red'> * Fax Number is Required </p>";
            $fax = "";
        }elseif(preg_match('/[a-zA-Z]/', $_REQUEST["fax"] ) ){ 
            $fax_err = "<p style='color:red'> * Only Numbers Allowed</p>";
            $fax_invalid = $_REQUEST["fax"];
            $fax = "";
        }else{
            $fax = $_REQUEST["fax"];
        }

        // if everyting got everything from user
        if(!empty($email) && !empty($address) && !empty($phn_no) && !empty($fax)){

            // database connection
            require_once "include/connection.php";

            $add_details  = "INSERT INTO contact_us(address , phn , email , fax) VALUES( '$address' , '$phn_no', '$email' , '$fax'  )";
            $result = mysqli_query($conn , $add_details);

            if($result){
                $address = $phn_no = $email = $fax =  "";
                 echo "<script>
                $(document).ready( function(){
                    $('#showModal').modal('show');
                    $('#linkBtn').hide();
                    $('#addMsg').text('Contact Details Updated Successfully!');
                    $('#closeBtn').text('OK');
                })
             </script>
             ";
            }
        }
    }
?>

<div class="login-form-bg h-100">
        <div class="container mt-5 h-100">
            <div class="row justify-content-center h-200">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">                       
                                    <h4 class="text-center pb-3">Add Contact Details</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            
                                <div class="form-group">
                                    <label >Address :</label>
                                    <input type="text" class="form-control" value="<?php  echo $address; ?>"  name="address" >  
                                    <?php echo $address_err; ?>
                                </div>
                                <div class="form-group">
                                    <label >Phone No. :</label>
                                    <input type="text" class="form-control" value="<?php if(empty($phn_no)){ echo $phn_no_invalid;}else{echo $phn_no;}  ?>"  name="phn" > 
                                    <?php echo $phn_no_err; ?> 
                                </div>

                                <div class="form-group">
                                    <label >Email :</label>
                                    <input type="text" class="form-control" value="<?php if(empty($email)){ echo $email_invalid;}else{echo $email;} ?>"  name="email" >  
                                    <?php echo $email_err; ?>
                                </div>

                                <div class="form-group">
                                    <label >Fax :</label>
                                    <input type="text" class="form-control" value="<?php if(empty($fax)){ echo $fax_invalid;}else{echo $fax;} ?>"  name="fax" >  
                                    <?php echo $fax_err; ?>
                                </div>

                                <button type="submit" class=" btn btn-primary btn-block">Add</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php 
    require_once "include/footer.php";
?>