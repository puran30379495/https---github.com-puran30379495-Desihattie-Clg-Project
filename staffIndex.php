
<?php 
session_start();

   include("connection.php");
   include("function.php");

   $user_data = check_stafflogin($con);

   if(isset($_POST['add_availability'])){

   $avaiDay = $_POST['avaiDay'];
   $avaiTime = $_POST['avaiTime'];
   $user_id = $user_data['user_id'];
   $user_name = $user_data['user_name'];
   $user_email = $user_data['user_email'];

   if(empty($avaiDay) || empty($avaiTime)){
      $message[] = 'please fill out all';
   }else{
      $insert = "insert into availability (user_id,user_name, user_email, selected_day, selected_time) VALUES('$user_id','$user_name','$user_email', '$avaiDay','$avaiTime')";
      $upload = mysqli_query($con,$insert);
      if($upload){
         $message[] = 'Availability sent successfully';
      }else{
         $message[] = 'could not sent availability at the moment';
      }
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Staff page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style4.css">
   <link rel="stylesheet" href="css/style2.css">

</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
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

input[type=text] {
    width: 100%;
    height: 100%;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 12px 35px 12px;
    transition: width 0.4s ease-in-out;
}
ul.topnav li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
}

.button1:hover {
  background-color: #4CAF50;
  color: white;
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
   margin: 0px 0px 0px 100px;
   font-size: 14px;
   font-family: Georgia;
   font-weight: bold;
   
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
   margin: 10px 0 10px 10px;
}

select option{
   font-family: Georgia;
   font-size: 14px;
}

.admin-product-form-container{
    margin-top: 50px;
}


</style>
</head>
<body>

<ul class="topnav">
<?php $sql = "SELECT * FROM orderdetails";
        $res = mysqli_query($con, $sql); ?>
  <li><a class="active" href="staffIndex.php">Home</a></li>
  <li><a href="staffOrder.php">Order</a></li>
  <li><a href="staffTable.php">Table</a></li>
  <li><a href="staffMail.php">Mail</a></li>
  <li><a href="staffProfile.php">Profile</a></li>
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
</ul>
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}
?>

<div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>send your availability</h3>
         <label class="select-boxes">Day :</label>
         <select name="avaiDay">
            <option value="Sunday">Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
        </select>
        <div>
        <label class="select-boxes">Time:</label>
        <select name="avaiTime">
            <option value="8am - 12pm">8am - 12pm</option>
            <option value="12pm - 2pm">12pm - 2pm</option>
            <option value="2pm - 5pm">2pm - 5pm</option>
            <option value="5pm - 8pm">5pm - 8pm</option>
            <option value="8pm - 10pm">8pm - 10pm</option>
        </select>
        </div>
         <input type="submit" class="btn" name="add_availability" value="send availability">
      </form>

   </div>
   
    <div class="containerRoaster">

        <h1>Roaster Time Table</h1>

        <div class="schedule__container">
            <div class="days__container">
                <span class="corner"></span>
                <div class="day">Sunday</div>
                <div class="day">Monday</div>
                <div class="day">Tuesday</div> 
                <div class="day">Wednesday</div>
                <div class="day">Thursday</div>
                <div class="day">Friday</div>
                <div class="day">Saturday</div>
            </div>

        <?php 
                    $query = "SELECT * FROM roaster";
                    $result = mysqli_query($con,$query);

         while($row = mysqli_fetch_array($result)){ ?>
            <div class="part__day">
                <span class="time">8am <br> - <br> 12pm</span>
                <div class="task">
                    <h5><?php echo $row['roaster1']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster2']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster3']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster4']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster5']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster6']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster7']; ?></h5>
                </div>
            </div>
            <div class="part__day">
                <span class="time">12pm <br> - <br> 2pm</span>
                <div class="task">
                    <h5><?php echo $row['roaster8']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster9']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster10']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster11']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster12']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster13']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster14']; ?></h5>
                </div>
            </div>
            <div class="part__day">
                <span class="time">2pm <br> - <br> 5pm</span>
                <div class="task">
                    <h5><?php echo $row['roaster15']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster16']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster17']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster18']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster19']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster20']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster21']; ?></h5>
                </div>
            </div>
            <div class="part__day">
                <span class="time">5pm <br> - <br> 8pm</span>
                <div class="task">
                    <h5><?php echo $row['roaster22']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster23']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster24']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster25']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster26']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster27']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster28']; ?></h5>
                </div>
            </div>
            <div class="part__day">
                <span class="time">8pm <br> - <br> 10pm</span>
                <div class="task">
                    <h5><?php echo $row['roaster29']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster30']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster31']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster32']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster33']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster34']; ?></h5>
                </div>
                <div class="task">
                    <h5><?php echo $row['roaster35']; ?></h5>
                </div>
            </div>
            <?php } ?>
        </div>
        </div>
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