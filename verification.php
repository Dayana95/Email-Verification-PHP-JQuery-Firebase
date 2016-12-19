<!DOCTYPE html>
<html>
<head>
  <title>Verification</title>
  <script type="text/javascript" src="firebase.js"></script>
</head>
<body>
<?php

        $verification_code = MD5(microtime());


function mailit($email_address){
        require_once('phpmailer/PHPMailerAutoload.php');

        global $verification_code;

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet="UTF-8";
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'espinoza8917@gmail.com';
        $mail->Password = 'pvdekhyiydwvhlzp';
        $mail->SMTPAuth = true;

        $mail->From = "milton@senorcoders.com";
        $mail->FromName = "milton@senorcoders.com";
        $mail->AddAddress($email_address);

        $mail->IsHTML(true);
        $mail->Subject    = "SQWAD Verification Request";
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
        $mail->Body    = "Click here to verify your email address <a href='http://sqwad.senorcoders.com/verify.php?code=".$verification_code."&email=".$email_address."' >Verify email address</a>";
        return $mail;
}

//$email_address =  explode("?",$_SERVER['REQUEST_URI'])[1];
if(isset($_GET)){
    //$getVars = array_keys($_GET);
    if(isset($_GET['email'])){
      //$email_address=$getVars[0];
      $email_address=$_GET['email'];
      if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        echo "email address is not correct";
      }else{
        $mail = mailit($email_address);

        if(!$mail->Send())
        {
          echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {

          echo "Message sent!";
          ?>


          <script>

          var pathname = window.location.href; 
          var emailArray = pathname.split("=");
          var emailSqwad = emailArray[1];
          console.log("URL", emailSqwad);

            var dbRef = new Firebase("https://sqwad-app.firebaseio.com/");
            var usersRef = dbRef.child('users');

          usersRef.orderByChild('email').equalTo(emailSqwad).once('value', function(snapvideo){
                                          if(snapvideo.val() === 'undefined' || snapvideo.val() === null){
                                                  console.log("Usuario no existe");
                                              }
                                              else{
                                                  snapvideo.forEach(function(childsnaphot){
                                                        console.log("KEY", childsnaphot.key());
                                                    var key = childsnaphot.key();
                                                       var code = "<?php echo $verification_code; ?>";

                                                     usersRef.child(key).update({
                                                    verification_code: code,
                                                      days_verify: 3,
                                                     verified: 'false'
                                                  })
                                                  })
                                                 

                                              }

              })


                
          </script>

          <?php
          die();
        }
      }
    }
}else{
  echo "there is not email address";
}

?>

</body>
</html>
