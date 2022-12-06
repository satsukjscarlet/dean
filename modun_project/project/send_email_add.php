<?php
function GuiMail($email_receive,$name_reveive, $noidungthu, $emailcc){   
    require "../../PHPMailer-master/src/PHPMailer.php"; 
    require "../../PHPMailer-master/src/SMTP.php"; 
    require '../../PHPMailer-master/src/Exception.php'; 
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
    try {
        $mail->SMTPDebug = 0; //0,1,2: chế độ debug. khi chạy ngon thì chỉnh lại 0 nhé
        $mail->isSMTP();  
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com';  //SMTP servers
        $mail->SMTPAuth = true; // Enable authentication
        $mail->Username = 'thientuantest@gmail.com'; // SMTP username
        $mail->Password = 'fndqcijmvpzwhpbn';   // SMTP password
        $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
        $mail->Port = 465;  // port to connect to                
        $mail->setFrom('thientuantest@gmail.com', 'Hệ thống đăng ký đề án' ); 
        $mail->addAddress($email_receive, $name_reveive); //mail và tên người nhận
        $mail->addCC('thientuantest@gmail.com', 'admin' );
        if(!empty($emailcc)){
            foreach ($emailcc as $value) {
             $mail->addCC($value, "" );
            }           
        } 
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Hệ thống đăng ký đề án';
        // $noidungthu = file_get_contents("Test.txt");
        // $noidungthu = str_replace(
        //     [ '{name_receive}'], 
        //     [$name_reveive]
        //     , $noidungthu);
        $mail->Body = $noidungthu;
        $mail->smtpConnect( array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        $mail->send();
        echo 'Đã gửi mail xong';
   
    } catch (Exception $e) {
        echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
    }
    // header('Location: http://localhost/dean/');
    // header('Location: http://localhost/datphong/web/');
 }//function GuiMail
 ?>

