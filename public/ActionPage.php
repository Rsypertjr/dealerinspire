
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require '/var/www/html/di/cf/vendor/autoload.php';
require('objectData.php');



class ActionPage{

    function __construct() {
          }


      public function make_contact($obj){
         // Create connection
        $conn = new mysqli($obj->servername, $obj->username, $obj->password, $obj->dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        
        
        $sql = "INSERT INTO Contacts (fullname, email, phone, message)".
        " VALUES('$obj->fullname','$obj->email','$obj->phone','$obj->message')";

        if ($conn->query($sql) === TRUE) {
            $obj->output .= "New record created successfully";
        } else {
            $obj->output .= "<br>Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

        return $obj;

      }

    function send_email($obj){
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
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
        <td>$obj->fullname</td>
        <td>$obj->email</td>
        <td>$obj->phone</td>
        <td>$obj->message</td>
        </tr>
        </table>
        </body>
        </html>
        ";


        $mail->Body = $bodyContent; 
        
        // Send email 
        if(!$mail->send()) { 
            $obj->output .=  '<br>Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
            } 
        else { 
            $obj->output .= '<br>Message has been sent.'; 
            } 

         
        return $obj;   
        }
    
}


if (isset($_POST['fullname'])) {
    $obj = new stdClass();
    $obj->fullname = $_POST['fullname'];
    $obj->email = $_POST['email'];
    $obj->phone = $_POST['phone'];
    $obj->message = $_POST['message'];
    $obj->servername = 'localhost';
    $obj->username = 'rlsjr';
    $obj->password = 'Sypert1234!';
    $obj->dbname = 'dealerinspire';
    $obj->output = '';
    $obj2 = new objectData($obj);
    $action_page = new ActionPage();
    $obj3 = $action_page->make_contact($obj2);
    $obj4 = $action_page->send_email($obj3);
    echo $obj4->output;

}

?>