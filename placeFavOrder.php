<?php 
session_start();

    include("connection.php");
    include("function.php");

    $user_data = check_login($con);
    $orderItem = '';
    $total = $_POST['total'];

    if(!empty($total)){

        $query = "SELECT * FROM wishlist";
        $result = mysqli_query($con,$query);
    
        while($row = mysqli_fetch_array($result)){ 
        
            $product_name = $row['product_name'];
            $product_qty = $_POST['product_qty'];
            if(!empty($product_qty)){
                $query = "update wishlist set product_qty = '".$product_qty."' where product_name = '".$product_name."'";
                mysqli_query($con, $query);
            }
            $orderItem = $orderItem." "." ".($row["product_name"]." ".$_POST['product_qty']);
        }
    }


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
        .containerBulk1{
            text-align: center;
            margin-top: 400px;
        }

        .popup1{
            width: 900px;
            background: #fff;
            border-radius: 6px;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%) scale(1);
            text-align: center;
            padding: 0 30px 30px;
            color: #333;
            transition: transform 0.4s, top 0.4s;
        }
        .popup1 button:hover {
            color: #bc9b5d;
            background: #353535;
        }

        .popup1 button{
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
                    <h3>Order Place</h3>
                </header>
                <form action= "payscript.php" method="post">
                    <div class="row form">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="full_name"placeholder="Full Name" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="Uemail"placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"name="contact" placeholder="Phone Number" />
                        </div>
                        <div class="form-group">
                            <p>Please choose whether you want to delivery your food or takeaway by yourself:</p>
                            <input type="radio" id="html" name="delivery" value="delivery">
                            <label for="html">delivery</label>
                            <input type="radio" id="css" name="delivery" value="takeaway">
                            <label for="css">takeaway</label><br>
                        </div>
                        <div class="form-group">
                            <p>Please select the spice level you want:</p>
                            <input type="radio" id="html" name="spiceLevel" value="low">
                            <label for="html">Low</label>
                            <input type="radio" id="css" name="spiceLevel" value="mild">
                            <label for="css">Mild</label><br>
                            <input type="radio" id="css" name="spiceLevel" value="high">
                            <label for="css">High</label><br>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="Uaddress" placeholder="Address" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"name="Ucity" placeholder="City" />
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="Ustate" placeholder="State" />
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="Uzip"placeholder="Zip" />
                            </div>
                            <input type="hidden" id="amount" name="amount" value="<?php echo $total?>">
                            <input type="hidden" value="<?php echo $orderItem;?>" name="orderDet" id="orderDet">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cards">
                            <p>We Accept:</p>
                            <img src="img/credit-cards.png" />
                        </div>
                        <div><span>Your total today: $<b id='atotal' name="amount" value='<?php echo $total?>'><?php echo $total?></b></span></div>
                    <div class="button">
                        <button type="submit" name="placeorder">Place Order</button>
                    </div>
                    </div>
                </form>
        
            
            </div>
            </div>
        </div>
            </div>
        </section>
        <!-- Cart Section End -->

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
        
    </body>
</html>