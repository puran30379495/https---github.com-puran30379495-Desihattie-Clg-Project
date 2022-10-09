<?php 
session_start();

    include("connection.php");
    include("function.php");

    $user_data = check_login($con);

    if(isset($_POST['update']))
    {
        //something was posted
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $user_phone = $_POST['user_phone'];
        $user_address = $_POST['user_address'];
        $user_id = $user_data['user_id'];


        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            if($password == $repassword){
            $query = "update users set user_name = '".$user_name."', user_email = '".$user_email."', password = '".$password."', user_phone = '".$user_phone."', user_address= '".$user_address."' where user_id = '".$user_id."'";
            mysqli_query($con, $query);

            header("Location: profile.php");
            die;
        }else{
            echo "Password doesnt match!";
        }
        }else
        {
            echo "Please enter valid information!";
        }
    }

    if (isset($_POST["addtocart"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'id' => $_GET["id"],
                    'name' => $_POST["hidden_name"],
                    'price' => $_POST["hidden_price"],
                    'quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="profile.php"</script>';
            }else{
                echo '<script>alert("Product is already Added to Cart")</script>';
                echo '<script>window.location="profile.php"</script>';
            }
        }else{
            $item_array = array(
                'id' => $_GET["id"],
                'name' => $_POST["hidden_name"],
                'price' => $_POST["hidden_price"],
                'quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }


    if(isset($_GET['remove'])){
        $id = $_GET['remove'];
        mysqli_query($con, "DELETE FROM wishlist WHERE id = $id");
        header('location:profile.php');
     };


?>


<?php


if(isset($_GET['productid'])){
    $productid = $_GET['productid'];

    $query = "SELECT * FROM productdetails where id = $productid";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);


    $query1 = "insert into wishlist (product_id, product_name, price) values ('".$productid."', '".$row['name']."', '".$row['price']."')";
    if(mysqli_query($con, $query1)){
        header("Location: profile.php");
        die;
    }
 };



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Desi Hattie </title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicons -->
        <link href="img/favicon.ico" rel="icon">
        <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600|Pacifico" rel="stylesheet"> 

        <!-- Bootstrap CSS File -->
        <link href="vendor/bootstrap/css/bootstrapp.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <!-- Libraries CSS Files -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="vendor/animate/animate.min.css" rel="stylesheet">
        <link href="vendor/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="vendor/tempusdominus/css/tempusdominus-bootstrapp-4.min.css" rel="stylesheet" />

        <!-- Main Stylesheet File -->
        <link href="css/style1.css" rel="stylesheet">

        <style>
            .btn{
                display: block;
                width: 100%;
                cursor: pointer;
                border-radius: .5rem;
                font-size: 1.1rem;
                padding:1rem 3rem;
                text-align: center;
            }

            .btn:hover{
   background: var(--black);
}
        .addBTN{
            background-color: #bc9b5d;
            border: none;
            color: black;
            border-radius: 16px;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .addBTN:hover{
            background-color: #353535;
            color: #bc9b5d;
}
        .containerBulk{
            text-align: center;
            margin-top: 10px;
        }
        .containerBulk1{
            text-align: center;
            margin-top: 400px;
        }
        .btnBulk{
            padding: 10px 60px;
            background: #bc9b5d;
            border: 0;
            outline: none;
            cursor: pointer;
            font-size: 22px;
            font-weight:500;
            border-radius: 30px;
            color: #353535;
        }

        .btnBulk:hover {
            color: #bc9b5d;
            background: #353535;
        }


        .popup{
            width: 600px;
            background: #fff;
            border-radius: 6px;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.1);
            text-align: center;
            padding: 0 30px 30px;
            color: #333;
            visibility: hidden;
            transition: transform 0.4s, top 0.4s;
        }

        .open-popup{
            visibility: visible;
            top:50%;
            transform: translate(-50%, -50%) scale(1);
        }

        .containerBulk table{
            margin-top: 5px;
        }

        .popup button{
            width: 100%;
            margin-top: 50px;
            padding: 10px 0;
            background: #bc9b5d;
            color: #353535;
            outline: none;
            border:0;
            font-size: 18px;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 5px 5px rhba(0,0,0,0.2);
        }

        .popup button:hover {
            color: #bc9b5d;
            background: #353535;
        }

        </style>
        
    </head>

    <body>

        <!-- Top Header Start -->
        <!-- <section id="top-header">
            <div class="logo">
                <a href="index.html"><img src="img/logo.png" /></a> 
            </div>
        </section> -->
        <!-- Top Header End -->

        <!-- Header Start -->
        <header id="header">
            <div class="container">
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                    <li class="logo" ><a href="index.php"><img src="img/logo.png" /></a> </li>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a style="display: flex"  href="cart.php">Cart<i style="margin-left: 3px; margin-top: 5px;"  class='fa fa-shopping-cart'></i></a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a class="menu-active" href="profile.php">Profile</a></li>
                        <div style="margin-left: 300px;">
                        <?php if(isset($_SESSION['user_id'])){ ?>
                            <a href="logout.php" style="text-decoration:none">logout</a>
                            <?php }else{ ?>
                            <a href="login.php" style="text-decoration:none">login</a>
                        <?php } ?>

                        </div>
                    </ul>
                </nav>
            </div>
        </header>
        <!-- Header End -->

        <!-- Reservations Section Start -->
        <section id="reservations">
            <div class="container">
                <header class="section-header">
                    <h3>Reservations</h3>
                </header>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="control-group col-sm-3">
                                <div class="form-group">
                                    <div class="input-group date" id="date" data-target-input="nearest">
                                        <input type="date" class="form-control datetimepicker-input" value="2022-05-14"
                                                    min="2022-05-14" max="2030-01-21" placeholder="Date" data-target="#date"/>
                                        <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                            <div class="input-group-text"></div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group col-sm-3">
                                <div class="form-group">
                                    <div class="input-group date" id="time" data-target-input="nearest">
                                        <input type="time" class="form-control datetimepicker-input" value="10:00" min="08:00" max="22:00"placeholder="Time" data-target="#time"/>
                                        <div class="input-group-append" data-target="#time" data-toggle="datetimepicker">
                                            <div class="input-group-text"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group col-sm-3">
                                <select class="custom-select">
                                    <option selected>Party Size</option>
                                    <option value="1">1 Person</option>
                                    <option value="2">2 People</option>
                                    <option value="3">3 People</option>
                                    <option value="4">4 People</option>
                                    <option value="5">5 People</option>
                                    <option value="6">6 People</option>
                                    <option value="7">7 People</option>
                                    <option value="8">8 People</option>
                                    <option value="9">9 People</option>
                                    <option value="10">10 People</option>
                                </select>
                            </div>
                            <div class="control-group col-sm-3">
                                <button class="btn btn-block btn-book">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Reservations Section End -->

        <!-- Cart Section Start -->
        <section id="cart">
            <div class="container">
                <header class="section-header">
                    <h3>Wishlist</h3>
                </header>
                <h3 class="title2">Wishlist Products</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="30%">Product Name</th>
                <th width="10%">Price</th>
                <th width="13%">Date and Time</th>
                <th width="13%"></th>
                <th width="10%"></th>
            </tr>

            <?php
            $query = "SELECT * FROM wishlist";
            $result = mysqli_query($con,$query);

            while($row = mysqli_fetch_array($result)){ ?>

                        <tr>
                            <form method="post" action="profile.php?id=<?=$row['id'] ?>">
                            <td><?php echo $row["product_name"]; ?></td>
                            <td><?php echo $row["price"]; ?></td>
                            <td><?php echo $row["time"]; ?></td>
                            <input type="hidden" name="hidden_name" value="<?= $row['product_name'] ?>">
                            <input type="hidden" name="hidden_price" value="<?= $row['price'] ?>">
                            <input type="hidden" name="quantity" value="1">
                            <td>
                            <button  name="addtocart" class="addBTN"><i class="fa fa-plus"></i> Order Now </button>
                            </td>
                            <td>
                            <a class="addBTN" href="profile.php?remove=<?php echo $row['id']; ?>"> <i class="fas fa-trash"></i> Remove </a>
                            </td>
                            </form>
                        </tr>
            <?php } ?>
            </table>
            <div class="containerBulk">
            <button type='submit' class='btnBulk' onClick="openPopup()">Bulk Order</button>
            <div class='popup' id="popup">
            <form action='placeFavOrder.php' method="post" enctype="multipart/form-data">
                <table class="table table-bordered">
            <tr>
                <th width="30%">Name</th>
                <th width="10%">Price</th>
                <th width="30%">QTY</th>
                <th width="13%">Subtotal</th>
            </tr>

            <?php
            $total=0;
            $orderItem = '';
            $query = "SELECT * FROM wishlist";
            $result = mysqli_query($con,$query);

            while($row = mysqli_fetch_array($result)){ 
                ?>
                        <tr>
                            <td><?php echo $row["product_name"]; ?><input type='hidden' class='iproduct' name='product_name' value='<?php echo $row["product_name"]; ?>' /></td>
                            <td>$<?php echo $row["price"]; ?><input type='hidden' class='iprice' value='<?php echo $row["price"]; ?>' /></td>
                            <td><input type="number" class="iquantity" name="product_qty" min="1" onChange='subTotal()' required="required" value='<?php echo $row["product_qty"]; ?>' /></td>
                            <td><h6 type="number" class="itotal" name="subtotal" required="required" ></h6></td>
                        </tr>
            <?php
            } ?>
            </table>
            <div><h2>Your total today: $<b id='gtotal' name='gtotal'></b></h2></div>
            <input type="text" placeholder="Enter Advance Payment" name="total">
            <button type='submit' onClick="closePopup()" name="placeOrderBulk">Place Order</button>
            </form>
            </div>
            </div>
        </div>
            </div>
        </section>
        <!-- Cart Section End -->

        <section id="login">
            <div class="container">
                <div class="section-header">
                    <h3>Update Profile</h3>
                </div>
                <div class="row">
                    <?php 
                    $u_name = $user_data['user_name'];
                    $u_email = $user_data['user_email'];
                    $u_phone = $user_data['user_phone'];
                    $u_address = $user_data['user_address'];
                    ?>
                    <div class="col-md-6">
                        <div class="login-col-1">
                            <div class="login-form">
                                <form method="post">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" name="user_name" placeholder="<?= $u_name ?>" required="required" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" class="form-control" name="user_email" placeholder="<?= $u_email ?>" required="required" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="password" class="form-control" name="password" placeholder="New Password" required="required" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="password" class="form-control" name="repassword" placeholder="Repeat New Password" required="required" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input class="form-control" name="user_phone" placeholder="<?= $u_phone ?>" required="required" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input class="form-control" name="user_address" placeholder="<?= $u_address ?>" required="required" />
                                        </div>
                                    </div>

                                    <div><button type="register" name="update">Update</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Cart Section End -->

        <section id="login">
            <div class="container">
                <div class="section-header">
                    <h3>Purchase History</h3>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="login-col-1">
                            <div class="login-form">
                            <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="30%">Order Items</th>
                <th width="10%">Total Amount</th>
                <th width="13%">Delivery</th>
                <th width="13%">Order Time</th>
            </tr>

            <?php
            $user_id = $user_data['user_id'];
            $query = "SELECT * FROM orderdetails where userid = '".$user_id."'";
            $result = mysqli_query($con,$query);

            while($row = mysqli_fetch_array($result)){ ?>

                        <tr>
                            <td><?php echo $row["orderdet"]; ?></td>
                            <td><?php echo $row["totalamt"]; ?></td>
                            <td><?php echo $row["delivery"]; ?></td>
                            <td><?php echo $row["orderTime"]; ?></td>
                        </tr>
            <?php } ?>
            </table>
        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Subscriber Section Start -->
        <section id="subscriber">
            <div class="container">
                <div class="section-header">
                    <h3>Get Latest Food Info</h3>
                </div>

                <div class="row">
                    <div class="col-12">
                        <form class="form-inline">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter Your Email">
                            </div>
                            <button type="submit" class="btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Subscriber Section end -->

        <!-- Footer Start -->
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="copyright">
							<p>&copy; Copyright <a href="#">Desi Hattie</a>. All Rights Reserved</p>
							
							<p>Designed By <a href="#">Puran and team</a></p>
                            
						</div>
                    </div>
                    <div class="col-sm-6">
                        <ul class="icon">
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-pinterest"></a></li>
                            <li><a href="#" class="fa fa-youtube"></a></li>
                        </ul>
                    </div>
                </div>
                <br>
            </div>
        </footer>
        <!-- Footer end -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/jquery/jquery-migrate.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/easing/easing.min.js"></script>
        <script src="vendor/stickyjs/sticky.js"></script>
        <script src="vendor/superfish/hoverIntent.js"></script>
        <script src="vendor/superfish/superfish.min.js"></script>
        <script src="vendor/owlcarousel/owl.carousel.min.js"></script>
        <script src="vendor/tempusdominus/js/moment.min.js"></script>
        <script src="vendor/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="vendor/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Main Javascript File -->
        <script src="js/main.js"></script>
        <script>
            let popup = document.getElementById("popup");
            let popup1 = document.getElementById("popup1");

            function openPopup(){
                popup.classList.add("open-popup");
            }

            function closePopup(){
                popup.classList.remove("open-popup");
            }
        </script>

        <script>
            var gt=0;
            var iprice = document.getElementsByClassName('iprice');
            var iquantity = document.getElementsByClassName('iquantity');
            var itotal = document.getElementsByClassName('itotal');
            var gtotal = document.getElementById('gtotal');
            var atotal = document.getElementById('atotal');
            function subTotal(){
                gt=0;
                for(i=0;i<iprice.length;i++){
                    itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);
                    gt=gt+(iprice[i].value)*(iquantity[i].value);
                }
                gtotal.innerText=gt;
                atotal.innerText=gt;
                document.getElementById("amount1").value = gt;
            }

            subTotal();
        </script>
        
    </body>
</html>