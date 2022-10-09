<?php 
session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'vendor/autoload.php';

?>
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

    </head>

<body>
  <div class="col-md-6 offset-md-3 mt-5">
    <a target="_blank" href="http://localhost/Desihattie/index.php">
      <img alt="DesiHattie Logo" src="img/logo.png">
    </a>
    <br>
    <a href="http://localhost/Desihattie/index.php" class="mt-3 d-flex">desihattie.com | Order food online.</a>
    <h1>Job Application Form</h1>
    <form accept-charset="UTF-8" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="InputName">Full Name</label>
        <input type="text" name="fullname" class="form-control" id="exampleInputName" placeholder="Enter your name and surname" required="required">
      </div>
      <div class="form-group">
        <label for="InputEmail1" required="required">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address">
      </div>
      <div class="form-group">
        <label for="inputAddress">Address</label>
        <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St">
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputCity">City</label>
          <input type="text" name="city" class="form-control" id="inputCity" placeholder="Sydney">
        </div>
        <div class="form-group col-md-2">
          <label for="inputZip">Zip</label>
          <input type="text" name="zip" class="form-control" id="inputZip" placeholder="34000">
        </div>
      </div>
      <div class="form-group">
        <label for="tel-input" class="col-2 col-form-label">Phone Number</label>
        <div class="col-10">
          <input class="form-control" name="tel" type="tel" placeholder="61-(555)-555-5555" id="example-tel-input">
        </div>
      </div>
      <div class="form-group mt-3">
        <label class="mr-4">Upload your CV:</label>
        <input type="file" name="file">
      </div>
      <button type="submit" name="sendMail" class="btn btn-primary">Submit</button>
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
                                    $mail->addAttachment($_FILES['file']['tmp_name'], 'resume.pdf');
                                    //Content
                                    $mail->isHTML(true);                                  //Set email format to HTML
                                    $mail->Subject = "Job Request"; 
                                    $mail->Body    = nl2br("Name: ".$_POST['fullname']."\n Email: ".$_POST['email']."\nAddress: ".$_POST['address']."\nCity: ".$_POST['city']."\nZip: ".$_POST['zip']."\nPhone Number: ".$_POST['tel']."\nThanks Desi Hattie",false);
                                    if($mail->send()){
                                        echo '<script>alert("Mail has been sent to admin")</script>';
        
                                        echo '<script>window.location="job.php"</script>';
                                    }else{
                                        echo '<script>alert("Mail cannot be sent at the moment. Please try again!!")</script>';
                                        echo '<script>window.location="job.php"</script>';
                                    }

                                };
                                ?>
    </form>
  </div>
</body>

</html>