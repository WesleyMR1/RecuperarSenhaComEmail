<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// ./lib
require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';


    

    
    


    function enviarEmail($destinatario, $assunto, $mensagem){
        try {
            $mail = new PHPMailer(true);

        $mail->isSMTP();                                     
        $mail->Host       = 'smtp.gmail.com';            
        $mail->SMTPAuth   = true;                             
        $mail->Username   = "testandoophpmaile@gmail.com";            
        $mail->Password   = 'pshvcilgczbbpfou';                      
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   
        $mail->Port       = 465;
        
            $mail->setFrom( 'testandoophpmaile@gmail.com', 'FACEID');

            //Recipients
            $mail->addAddress($destinatario, 'USUARIO');    
            //Content
            $mail->isHTML(true);                    
            $mail->Subject = $assunto;
            $mail->Body    = $mensagem;
        
            $mail->send();
        } catch (Exception $e) {
            die( "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
