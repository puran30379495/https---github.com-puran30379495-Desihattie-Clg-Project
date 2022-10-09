<?php 
session_start();

	include("connection.php");
	include("function.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'vendor/autoload.php';

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

        <!-- Libraries CSS Files -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="vendor/animate/animate.min.css" rel="stylesheet">
        <link href="vendor/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="vendor/tempusdominus/css/tempusdominus-bootstrapp-4.min.css" rel="stylesheet" />

        <!-- Main Stylesheet File -->
        <link href="css/style1.css" rel="stylesheet">
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
                        <li class="menu-active"><a href="contact.php">Contact</a></li>
                        <li><a href="profile.php">Profile</a></li>
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

        
        <!-- Contact Section Start -->
        <section id="contact">
            <div class="container">
                <div class="section-header">
                    <h3>Contact Us</h3>
                </div>
                
                <div class="row contact-detail">
                    <div class="col-md-6">
                        <div class="contact-col-1">
                            <div class="contact-hours">
                                <h4>Opening Hours</h4>
                                <p>Saturday-Tuesday: 08.00am to 10.00pm</p>
                                <p>Wednesday-Thursday: 08.00am to 03.00pm</p>
                                <p>Friday: 03.00pm to 09.00pm</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-col-2">
                            <div class="contact-info">
                                <h4>Contact Info</h4>
                                <p>120 Liverpool street , Strathfield, NSW </p>
                                <p><a href="tel:+123-456-789">+123-456-789</a></p>
                                <p><a href="mailto:name@domainname.com">DesiHattie@gmail.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d12623.52751148822!2d-122.47260557388145!3d37.72245039905841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s220%2C+San+Francisco%2C+California%2C+USA!5e0!3m2!1sen!2sbd!4v1555690883913!5m2!1sen!2sbd" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="contact-form">
                            <form method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" placeholder="Your Name" name="name" required="required" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" class="form-control" placeholder="Your Email" name="email" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Subject" name="subject" required="required" />
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" placeholder="Message" name="message" required="required" ></textarea>
                                </div>
                                <div><button type="submit" name="sendMail">Send Message</button></div>
                                <?php
                                if(isset($_POST['sendMail'])){
                                    $mail=new PHPMailer(true);
                                    $mail->isSMTP();                                            //Send using SMTP
                                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                    $mail->Username   = 'ecommerce19168@gmail.com';                     //SMTP username
                                    $mail->Password   = 'btqvcjanxmpptjzk';                               //SMTP password
                                    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                                    $mail->Port       = 587;  

                                    //Recipients
                                    $mail->setFrom("ecommerce19168@gmail.com");
                                    $mail->addReplyTo("ecommerce19168@gmail.com");
                                    $mail->addAddress("ecommerce19168@gmail.com");
                                    //Content
                                    $mail->isHTML(true);                                  //Set email format to HTML
                                    $mail->Subject = $_POST['subject']; 
                                    $mail->Body    = nl2br("Subject:".$_POST['subject']."\n Name: ".$_POST['name']."\n Email: ".$_POST['email']."\nMessage: ".$_POST['message']."\nThanks Desi Hattie",false);
                                    if($mail->send()){
                                        echo '<script>alert("Mail has been sent to admin")</script>';
        
                                        echo '<script>window.location="contact.php"</script>';
                                    }else{
                                        echo '<script>alert("Mail cannot be sent at the moment. Please try again!!")</script>';
                                        echo '<script>window.location="contact.php"</script>';
                                    }

                                };
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Section End -->

        <h2 style="margin-left: 100px;">If you interested on joining our staff:<a href="job.php"><button type="submit" style="margin-left: 30px;" class="btn btn-primary">Click here to join</button></a></h2>
            
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

    </body>
</html>
