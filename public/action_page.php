
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require '../vendor/autoload.php';





    $servername = "localhost";
    $username = "rlsjr";
    $password = "Sypert1234!";
    $dbname = "dealerinspire";



    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO Contacts (fullname, email, phone, message)".
    " VALUES('$fullname','$email','$phone','$message')";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
/*
    $to = "rsypertjr@hotmail.com";
    $subject = "My subject";
    $txt = "Hello world!";
    $headers = "From: rsypertjr@hotmail.com";
    
$result = mail($to,$subject,$txt,$headers);
if (!$result) {
    echo "error";
  }
else{
    echo "sent";
}
*/

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

    //Server settings
    $mail->SMTPDebug = 3;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'rlsjrtest@gmail.com';                     //SMTP username
    $mail->Password   = 'syp3rtjr2!';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Sender info 
$mail->setFrom('sender@dealerinspire.com', 'DealerInspire'); 
$mail->addReplyTo('reply@dealerinspire.com', 'DealerInspire'); 
 
// Add a recipient 
$mail->addAddress('guy-smiley@example.com'); 
 
//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'New Contact Info'; 
 
// Mail body content 
$bodyContent = "
<html>
<head>
<title>New Contact Info</title>
</head>
<body>
<table>
<tr>
<th>FullName</th>
<th>Email</th>
<th>Phone</th>
<th>Message</th>
</tr>
<tr>
<td>$fullname</td>
<td>$email</td>
<td>$phone</td>
<td>$message</td>
</tr>
</table>
</body>
</html>
";


$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    echo 'Message has been sent.'; 
} 

?>