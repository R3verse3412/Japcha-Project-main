<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';
    
class YourEmailClass {
    public function get_email($email, $username) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                 // Enable verbose debug output
            $mail->SMTPDebug = 0;
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'adnerdevila23@gmail.com';                     // SMTP username
            $mail->Password   = 'tcgs yycp hgfp iaxv';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // Enable implicit TLS encryption
            $mail->Port       = 587;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom('adnerdevila23@gmail.com', 'JapCha');
            $mail->addAddress($email, $username);     // Add a recipient

            $mail->isHTML(true);
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            // Store the OTP in the session
            $_SESSION['verification_code'] = [
                'code' => $verification_code,
                'timestamp' => time(),
            ];

            $mail->Subject = 'Email Verification';
            // $mail->Body    = '<p>Your Verification code is: <b style="font-size: 30px; ">'. $verification_code .'</b></p> ';
            $mail->Body = '<div class="card" style=" width: 400px; height: 200px;">
            <div class="card-header"  style="border: 1px solid black; background-color: #978d30; width: 100%;padding: 2px; text-align: center;">
                <b class="card-title" style="font-size: 25px; width: 100%;">Verification Code:</b>
            </div>
            <div class="card-body" style="border: 1px solid black; padding: 2px; width:100%; text-align: center;">
             <b style="font-size: 50px;">'. $verification_code .'</b>
            </div>
            </div>
        </div>';

            $mail->Body =' <div style="width: 500px; margin: 0 auto; text-align: center; font-family: Arial, sans-serif;">
                                <div style="margin-bottom: 20px;">
                                    <div><strong style="font-size: 50px; color:#bac260; font-weight: 800;">JapCha</strong></div>
                                    <span style="font-size: 12px;">A warm welcome from JapCha &#x1F60A;</span>
                                </div>
                                <div>&nbsp;</div>
                                <div style="font-size: 20px;">Dear user, please use the verificcation code to continue to register your account:</div>
                                <div>&nbsp;</div>
                                <div><span style="margin-bottom: 20px; font-size: 50px; color: black;">&#x1F512;</span></div>
                                <div><strong style="font-size: 20px;">'. $verification_code .'</strong></div>
                            </div>';
            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


    public function send_email($email, $username) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                 // Enable verbose debug output
            $mail->SMTPDebug = 0;
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'adnerdevila23@gmail.com';                     // SMTP username
            $mail->Password   = 'tcgs yycp hgfp iaxv';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // Enable implicit TLS encryption
            $mail->Port       = 587;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom('adnerdevila23@gmail.com', 'JapCha');
            $mail->addAddress($email, $username);     // Add a recipient

            $mail->isHTML(true);
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            // Store the OTP in the session

            $mail->Subject = 'Preparing Order';
            // $mail->Body    = '<p>Your Verification code is: <b style="font-size: 30px; ">'. $verification_code .'</b></p> ';
            
            $items = [
                ['Mango Shake', 'Large', 'x2'],
                ['Mango Shake', 'Large', 'x2']
                // Add more items as needed
            ];
            
            // Calculate the total price
            $totalPrice = 120; // Replace this with your actual total price calculation
            
            // Initialize the email body
            $emailBody = '<h2><strong>Order Summary</strong></h2><br>';
            
            // Iterate over each item
            foreach ($items as $item) {
                $emailBody .= '<div>';
                foreach ($item as $detail) {
                    $emailBody .= '<div>' . htmlspecialchars($detail) . '</div>';
                }
                $emailBody .= '</div>';
            }
            
            // Add the total section
            $emailBody .= '<div><strong>TOTAL: </strong><strong>₱ ' . $totalPrice . '</strong></div>';
            
            // Assign the email body to PHPMailer
            $mail->Body = $emailBody;


            // $mail->Body = '<h2><strong>Order Summary</strong></h2>
            // <div>
            //     <div>Mango Shake</div>
            //     <div >Large</div>
            //     <div>x2</div>
            // </div>
            // <div>
            //     <div>Mango Shake</div>
            //     <div>Large</div>
            //     <div>x2</div>
            // </div>
            // <div>
            //         <strong>TOTAL: </strong>
            //         <strong>₱ 120</strong>
            // </div>
            // ';
            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    public function preparing_order($email, $username, $total_price, $orderid, $OrderDate) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                 // Enable verbose debug output
            $mail->SMTPDebug = 0;
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'adnerdevila23@gmail.com';                     // SMTP username
            $mail->Password   = 'tcgs yycp hgfp iaxv';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // Enable implicit TLS encryption
            $mail->Port       = 587;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom('adnerdevila23@gmail.com', 'JapCha');
            $mail->addAddress($email, $username);     // Add a recipient

            $mail->isHTML(true);
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            // Store the OTP in the session

            $mail->Subject = 'Preparing Order';
            // $mail->Body    = '<p>Your Verification code is: <b style="font-size: 30px; ">'. $verification_code .'</b></p> ';   
            // Assign the email body to PHPMailer
            $mail->Body = '<div style="width: 500px; margin: 0 auto; text-align: center; font-family: Arial, sans-serif;">
            <div style="margin-bottom: 20px;">
                <strong style="font-size: 50px; color:#bac260; font-weight: 800;">JapCha</strong>
            </div>
            <div>&nbsp;</div>
            <div>Thank you for ordering! Please see information below for the order details</div>
            <div>&nbsp;</div>
            <div><strong style="font-size: 20px;">ORDER DETAILS:</strong></div>
            <div>&nbsp;</div>
            <div>Order No: '. $orderid . '</div>
            <div>Order Date: ' . $OrderDate . '</div>
            <div>&nbsp;</div>
            <div><strong style="font-size: 20px;">Total Price: ₱'. $total_price .'</strong></div>
        </div>';


            // $mail->Body = '<h2><strong>Order Summary</strong></h2>
            // <div>
            //     <div>Mango Shake</div>
            //     <div >Large</div>
            //     <div>x2</div>
            // </div>
            // <div>
            //     <div>Mango Shake</div>
            //     <div>Large</div>
            //     <div>x2</div>
            // </div>
            // <div>
            //         <strong>TOTAL: </strong>
            //         <strong>₱ 120</strong>
            // </div>
            // ';
            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function to_deliver($email, $username, $total_price, $orderid, $OrderDate) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                 // Enable verbose debug output
            $mail->SMTPDebug = 0;
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'adnerdevila23@gmail.com';                     // SMTP username
            $mail->Password   = 'tcgs yycp hgfp iaxv';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // Enable implicit TLS encryption
            $mail->Port       = 587;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom('adnerdevila23@gmail.com', 'JapCha');
            $mail->addAddress($email, $username);     // Add a recipient

            $mail->isHTML(true);
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            // Store the OTP in the session

            $mail->Subject = 'Order is placed on Delivery';
            // $mail->Body    = '<p>Your Verification code is: <b style="font-size: 30px; ">'. $verification_code .'</b></p> ';   
            // Assign the email body to PHPMailer
            $mail->Body = '<div style="width: 500px; margin: 0 auto; text-align: center; font-family: Arial, sans-serif;">
            <div style="margin-bottom: 20px;">
                <strong style="font-size: 50px; color:#bac260; font-weight: 800;">JapCha</strong>
            </div>
            <div>&nbsp;</div>
            <div>Thank you for ordering! Order Will be deliver shortly, Please see information below for the order details</div>
            <div>&nbsp;</div>
            <div><strong style="font-size: 20px;">ORDER DETAILS:</strong></div>
            <div>&nbsp;</div>
            <div>Order No: '. $orderid . '</div>
            <div>Order Date: ' . $OrderDate . '</div>
            <div>&nbsp;</div>
            <div><strong style="font-size: 20px;">Total Price: ₱'. $total_price .'</strong></div>
        </div>';
            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function complete_oder($email, $username, $total_price, $orderid, $OrderDate) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                 // Enable verbose debug output
            $mail->SMTPDebug = 0;
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'adnerdevila23@gmail.com';                     // SMTP username
            $mail->Password   = 'tcgs yycp hgfp iaxv';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // Enable implicit TLS encryption
            $mail->Port       = 587;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom('adnerdevila23@gmail.com', 'JapCha');
            $mail->addAddress($email, $username);     // Add a recipient

            $mail->isHTML(true);
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            // Store the OTP in the session

            $mail->Subject = 'Order Completed';
            // $mail->Body    = '<p>Your Verification code is: <b style="font-size: 30px; ">'. $verification_code .'</b></p> ';   
            // Assign the email body to PHPMailer
            $mail->Body = '<div style="width: 500px; margin: 0 auto; text-align: center; font-family: Arial, sans-serif;">
            <div style="margin-bottom: 20px;">
                <strong style="font-size: 50px; color:#bac260; font-weight: 800;">JapCha</strong>
            </div>
            <div>&nbsp;</div>
            <div>Thank you for ordering! Japcha is happy to serve you!</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div><strong style="font-size: 20px;">Total Price: ₱'. $total_price .'</strong></div>
            <div><span style="margin-bottom: 20px; font-size: 50px;">✔️</span></div>
            <strong style="font-size: 20px; color: green;">Completed</strong> 
        </div>';
            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function send_notif_banned($email) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                 // Enable verbose debug output
            $mail->SMTPDebug = 0;
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'adnerdevila23@gmail.com';                     // SMTP username
            $mail->Password   = 'tcgs yycp hgfp iaxv';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // Enable implicit TLS encryption
            $mail->Port       = 587;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom('adnerdevila23@gmail.com', 'JapCha');
            $mail->addAddress($email);     

            $mail->isHTML(true);

            $mail->Subject = 'Account Temporarily Banned';

            $mail->Body ='<div style="width: 500px; margin: 0 auto; text-align: center; font-family: Arial, sans-serif;">
            <div style="margin-bottom: 20px;">
                    <div><strong style="font-size: 50px; color:#bac260; font-weight: 800;">JapCha</strong></div>
                    <span style="font-size: 12px; color: red;">Your account has been temporarily banned due to violations</span>
                    <div>&nbsp;</div>
                    <span style="font-size: 20px; color: red;">⚠️ ⚠️ ⚠️</span>
                </div>
                <div>Dear user, this email is to inform you that you account is banned for commiting violations inside the cyberspace. Thank you!</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
            </div>';
            
            // Assign the email body to PHPMailer
         
            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function send_notif_perma_banned($email) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                 // Enable verbose debug output
            $mail->SMTPDebug = 0;
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'adnerdevila23@gmail.com';                     // SMTP username
            $mail->Password   = 'tcgs yycp hgfp iaxv';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // Enable implicit TLS encryption
            $mail->Port       = 587;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom('adnerdevila23@gmail.com', 'JapCha');
            $mail->addAddress($email);     

            $mail->isHTML(true);

            $mail->Subject = 'Account Permanently Banned';

            $mail->Body ='<div style="width: 500px; margin: 0 auto; text-align: center; font-family: Arial, sans-serif;">
            <div style="margin-bottom: 20px;">
                    <div><strong style="font-size: 50px; color:#bac260; font-weight: 800;">JapCha</strong></div>
                    <span style="font-size: 12px; color: red;">Your account has been permanently banned due to violations</span>
                    <div>&nbsp;</div>
                    <span style="font-size: 20px; color: red;">⚠️ ⚠️ ⚠️</span>
                </div>
                <div>Dear user, this email is to inform you that you account is banned for commiting violations inside the cyberspace. Thank you!</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
            </div>';
            
            // Assign the email body to PHPMailer
         
            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function send_notif_reactivate_account($email) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                 // Enable verbose debug output
            $mail->SMTPDebug = 0;
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'adnerdevila23@gmail.com';                     // SMTP username
            $mail->Password   = 'tcgs yycp hgfp iaxv';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // Enable implicit TLS encryption
            $mail->Port       = 587;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom('adnerdevila23@gmail.com', 'JapCha');
            $mail->addAddress($email);     

            $mail->isHTML(true);

            $mail->Subject = 'Account Reactivated';

            $mail->Body ='<div style="width: 500px; margin: 0 auto; text-align: center; font-family: Arial, sans-serif;">
            <div style="margin-bottom: 20px;">
                <div><strong style="font-size: 50px; color:#bac260; font-weight: 800;">JapCha</strong></div>
                <span style="font-size: 12px; color: green;">Your account has been reactivated. You can now login</span>
                <div>&nbsp;</div>  
            </div>
            <div>&nbsp;</div>
            <div>Dear user, this email is to inform you that your account has been reactivated, you can try loging in again. Thank you!</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
    
        </div>';
            
            // Assign the email body to PHPMailer
         
            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}

