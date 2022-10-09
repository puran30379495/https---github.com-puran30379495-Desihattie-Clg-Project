<?php 
session_start();

   include("connection.php");
   include("function.php");

   $user_data = check_stafflogin($con);


   if(isset($_POST['update_details'])){

   $name = $_POST['user_name'];
   $email = $_POST['user_email'];
   $phone = $_POST['user_phone'];
   $password = $_POST['password'];
   $id = $user_data['user_id'];
   

   if(empty($name) || empty($email) || empty($password) || empty($phone)){
      $message[] = 'please fill out all';
   }else{
      $insert = "update staffusers set user_name = '".$name."', user_email = '".$email."',user_phone = '".$phone."', password = '".$password."' where user_id = '".$id."'";
      $upload = mysqli_query($con,$insert);
      mysqli_query($con, $insert);
      if($upload){
         $message[] = 'Details Changed successfully';
      }else{
         $message[] = 'could not change the details';
      }
   }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Staff Page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style2.css">

</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  html{
    font-size: 12px;
  }
body {margin: 0;}


ul.topnav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
  top: 0;
  font-size: 15px;
}

ul.topnav li {float: left;}

ul.topnav li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

ul.topnav li i {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

ul.topnav li a:hover:not(.active) {background-color: #111;}
ul.topnav li i:hover:not(.active) {background-color: #111;}

ul.topnav li a.active {background-color: #04AA6D;}
ul.topnav li i.active {background-color: #04AA6D;}

ul.topnav li.right {float: right;}

@media screen and (max-width: 600px) {
  ul.topnav li.right, 
  ul.topnav li {float: none;}
}

#dropdownID {
   width: 285px;
   padding: 28px;
   border: 1px solid #ccc;
   box-shadow: 0 2px 10px rgba(0,0,0,0.2);
   position: absolute;
   right: 100px;
   top: 45px;
   display: none;
}

#dropdownID span{
   display: block;
   margin-bottom: 5px; 
   position: relative;
}


#dropdownID .notName {
   font-weight: bold;
   text-align: center;
   font-size: 18px;
   position: relative;
   display: inline-block;
}

#dropdropdown-wrapper{
   display: inline-block;
}

#dropdown-wrapper:hover 
#dropdownID{
   display: block;
}

.product-display{
   margin:2rem 0;
   display: flex;
   align-items: center;
   justify-content: center;
}

.product-display .product-display-table{
   width: 60%;
   text-align: center;
}



</style>
</head>
<body>

<ul class="topnav">
   <?php $sql = "SELECT * FROM orderdetails";
        $res = mysqli_query($con, $sql); ?>
  <li><a href="staffIndex.php">Home</a></li>
  <li><a href="staffOrder.php">Order</a></li>
  <li><a href="staffTable.php">Table</a></li>
  <li><a href="staffMail.php">Mail</a></li>
  <li><a class="active" href="staffProfile.php">Profile</a></li>
  <li class="right"><a href="logout.php">Logout</a></li>
  <div id="dropdown-wrapper">
  <li class="right"><i class="fa fa-bell" aria-hidden="true" id="noti_number"> 5</i>
  <div class="dropdown" id="dropdownID">
          <?php
          if (mysqli_num_rows($res) > 0) {
            foreach ($res as $item) {
          ?>
            <span class="notName"><?php echo $item["name"]; ?></span>
            <span class="notDet"><?php echo $item["orderdet"]; ?></span>
          <?php }
          } ?>
        </div>
  </div>
</li>
</ul>



<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   
   <div class="admin-product-form-container centered">

   <?php
      
      $id = $user_data['id'];
      $select = mysqli_query($con, "SELECT * FROM staffusers WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form method="post" enctype="multipart/form-data">
      <h3 class="title">update the Details</h3>
      <input type="text" class="box" name="user_name" value="<?php echo $row['user_name']; ?>" placeholder="enter the product name">
      <input type="email" class="box" name="user_email" value="<?php echo $row['user_email']; ?>" value="<?php echo $row['user_email']; ?>">
      <input type="number" class="box" name="user_phone" value="<?php echo $row['user_phone']; ?>" value="<?php echo $row['user_phone']; ?>">
      <input type="password" class="box" name="password" placeholder="enter the new password">
      <input type="submit" value="update details" name="update_details" class="btn">
   </form>

   <?php }; ?>


</div>
   
   <script type="text/javascript">
   function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("noti_number").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "noOfOrders.php", true);
  xhttp.send();
}
loadDoc();
</script>
</body>
</html>


