<?php 
session_start();

   include("connection.php");
   include("function.php");

   $user_data = check_adminlogin($con);

   if(isset($_POST['add_staff'])){

   $staff_name = $_POST['staff_name'];
   $staff_email = $_POST['staff_email'];
   $staff_phone = $_POST['staff_phone'];
   $staff_psw = $_POST['staff_password'];
   $staff_role = $_POST['staff_role'];

   if(empty($staff_name) || empty($staff_email) || empty($staff_phone) || empty($staff_psw) || empty($staff_role)){
      $message[] = 'please fill out all';
   }else{
      $insert = "insert into staffusers (user_name, user_email, user_phone, password, role) VALUES('".$staff_name."','".$staff_email."','".$staff_phone."','".$staff_psw."','".$staff_role."')";
      $upload = mysqli_query($con,$insert);
      if($upload){
         $message[] = 'new staff added successfully';
      }else{
         $message[] = 'could not add the staff';
      }
   }

};


if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($con, "DELETE FROM staffusers WHERE id = $id");
    header('location:staff.php');
 };

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin page</title>

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
  <li><a href="adminIndex.php">Home</a></li>
  <li><a href="viewOrders.php">Order</a></li>
  <li><a href="roasterUpdate.php">Roaster</a></li>
  <li><a href="adminTable.php">Table</a></li>
  <li><a href="userMail.php">Mail</a></li>
  <li><a class="active" href="staff.php">Staff</a></li>
  <li><a href="adminUserList.php">User</a></li>
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
   
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a staff product</h3>
         <input type="text" placeholder="enter staff name" name="staff_name" class="box">
         <input type="text" placeholder="enter email name" name="staff_email" class="box">
         <input type="number" placeholder="enter contact number" name="staff_phone" class="box">
         <input type="password" placeholder="enter password" name="staff_password" class="box">
         <input type="text" placeholder="enter role" name="staff_role" class="box">
         <input type="submit" class="btn" name="add_staff" value="add staff">
      </form>

   </div>
</div>
   <?php

   $select = mysqli_query($con, "SELECT * FROM staffusers");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Role</th>
            <th>Remove</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['user_email']; ?></td>
            <td><?php echo $row['user_phone']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td><a href="staff.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a></td>
         </tr>
      <?php } ?>
      </table>
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


