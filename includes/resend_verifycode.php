<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['email'])){
        $email_to_resend = $_POST['email'];
        $fname_to_resend = $_POST['fname'];

        require_once "../classes/mailer_function.php";
        $mailer = new YourEmailClass();
        $mailer->get_email($email_to_resend, $fname_to_resend);
    }
}