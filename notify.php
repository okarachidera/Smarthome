<?php

use PHPMailer\PHPMailer\PHPMailer;


	//form validation
    function notify($email,$name,$subject,$body){

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";
    
        $mail = new PHPMailer();
    
        //smtp settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "ckgraphite@gmail.com";
        $mail->Password = 'chider11';
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";
  
      
    
        //email settings
        $mail->isHTML(true);
        $mail->setFrom($email, $subject);
        $mail->addAddress("$email");
        $mail->Subject = ("$email (OTP CODE)");
        $mail->Body = $body;
  

        if($mail->send()){
            echo 'success';      
            }else{
                echo 'failed';
      
            }
}

function smsalert($subject,$body,$phone){



   // Initialize variables ( set your variables here )

        $username = 'okara.chidera@gmail.com';

        $password = 'Passw0rd';

        $sender   = $subject;

        $message  = $body;

        // Separate multiple numbers by comma

        $mobiles  = $phone;

        // Set your domain's API URL

        $api_url  = 'https://portal.nigeriabulksms.com/api/';


        //Create the message data

        $data = array('username'=>$username, 'password'=>$password, 'sender'=>$sender, 'message'=>$message, 'mobiles'=>$mobiles);

        //URL encode the message data

        $data = http_build_query($data);

        //Send the message


        $request = $api_url.'?'.$data;

        $result  = file_get_contents($request);

        $result  = json_decode($result);


        if(isset($result->status) && strtoupper($result->status) == 'OK')
        {
            // Message sent successfully, do anything here

            echo 'Message sent at N'.$result->price;

        }
        else if(isset($result->error))
        {
            // Message failed, check reason.

        echo 'Message failed - error: '.$result->error;
        }
        else
        {
            // Could not determine the message response.

            echo 'Unable to process request';
        }

}




//    }

?>
