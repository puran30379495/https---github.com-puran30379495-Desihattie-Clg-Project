<?php 
session_start();

   include("connection.php");
   include("function.php");

   $user_data = check_adminlogin($con);


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


.select-boxes{
   width: 280px;
   text-align: center;
   margin: 0 auto;
   font-size: 14px;
}

select {
   background-color: #f5f5f5;
   border: 1px double #FB4314;
   color: black;
   font-family: Georgia;
   font-weight: bold;
   font-size: 16px;
   height: 39px;
   padding: 7px 8px;
   width: 250px;
   outline: none;
   margin: 10px 0 10px 20px;
}

select option{
   font-family: Georgia;
   font-size: 14px;
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
  <li><a href="staff.php">Staff</a></li>
  <li><a class="active" href="adminUserList.php">User</a></li>
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
   
   <?php

   $select = mysqli_query($con, "SELECT * FROM users");
   
   ?>
   
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            
            <th>Id</th>
            <th>name</th>
            <th>email</th>
            <th>phone</th>
            <th>address</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['user_email']; ?></td>
            <td><?php echo $row['user_phone']; ?></td>
            <td><?php echo $row['user_address']; ?></td>
            <td>
               <a href="adminUserList.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> block </a>
            </td>
         </tr>
      <?php 

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query1 = "SELECT * FROM users where id = $id";
    $result1 = mysqli_query($con,$query1);
    while($row1 = mysqli_fetch_array($result1)){
        $id = $row1['id'];
        $user_id = $row1['user_id'];
        $user_name = $row1['user_name'];
        $user_email = $row1['user_email'];
        $password = $row1['password'];
        $user_phone = $row1['user_phone'];
        $user_address = $row1['user_address'];
        $query = "insert into blockeduser (id,user_id,user_name,user_email,password,user_phone,user_address) values ('$id','$user_id','$user_name','$user_email','$password','$user_phone','$user_address')";
        mysqli_query($con, $query);
    }
    mysqli_query($con, "DELETE FROM users WHERE id = $id");
    echo '<script>window.location="adminUserList.php"</script>';
 };
    } ?>
      </table>
   </div>

   <h2 style="text-align: center; font-size: 40px">Blocked User</h2>

      
   <?php

   $select = mysqli_query($con, "SELECT * FROM blockeduser");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            
            <th>Id</th>
            <th>name</th>
            <th>email</th>
            <th>phone</th>
            <th>address</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['user_email']; ?></td>
            <td><?php echo $row['user_phone']; ?></td>
            <td><?php echo $row['user_address']; ?></td>
            <td>
            <a href="adminUserList.php?unblock=<?php echo $row['id']; ?>" class="btn" style="background-color: green"> <i class="fas fa-edit"></i> Unblock </a>
            </td>
         </tr>
      <?php 

if(isset($_GET['unblock'])){
    $id = $_GET['unblock'];
    $query3 = "SELECT * FROM blockeduser where id = $id";
    $result3 = mysqli_query($con,$query3);
    while($row3 = mysqli_fetch_array($result3)){
        $id = $row3['id'];
        $user_id = $row3['user_id'];
        $user_name = $row3['user_name'];
        $user_email = $row3['user_email'];
        $password = $row3['password'];
        $user_phone = $row3['user_phone'];
        $user_address = $row3['user_address'];
        $query3 = "insert into users (id,user_id,user_name,user_email,password,user_phone,user_address) values ('$id','$user_id','$user_name','$user_email','$password','$user_phone','$user_address')";
        mysqli_query($con, $query3);
    }
    mysqli_query($con, "DELETE FROM blockeduser WHERE id = $id");
    echo '<script>window.location="adminUserList.php"</script>';
 };
    
    
    } ?>
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


