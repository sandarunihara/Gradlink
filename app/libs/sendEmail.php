<?php
require "../app/libs/SMTP.php";
require "../app/libs/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    static function sendEmail($email)
    {

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hiranyagunawardhane@gmail.com';
        $mail->Password = 'dchmdrjebuiykvqh';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('hiranyagunawardhane@gmail.com', 'Reset Password');
        $mail->addReplyTo('hiranyagunawardhane@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Invitation to Join UCSC PDC Internship Program';
        $bodyContent = '
<!DOCTYPE html>
<html>
<head>
    <title>Invitation to Join UCSC PDC Internship Program</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border: 1px solid #dddddd; padding: 20px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="https://www.ucsc.cmb.ac.lk/wp-content/uploads/2020/05/ucsc-logo.png" alt="UCSC Logo" style="max-width: 150px;">
        </div>
        <h2 style="text-align: center; color: #333333;">Invitation to Join UCSC PDC Internship Program</h2>
        <p style="font-size: 16px; color: #555555; line-height: 1.5;">
            Dear [Company Name],
        </p>
        <p style="font-size: 16px; color: #555555; line-height: 1.5;">
            Greetings from the University of Colombo School of Computing (UCSC). We are excited to announce the launch of our undergraduate internship program, hosted by our Professional Development Center (PDC). This program connects talented undergraduate students specializing in Computer Science and IT with esteemed companies like yours.
        </p>
        <p style="font-size: 16px; color: #555555; line-height: 1.5;">
            We invite you to join us in shaping the future of these young professionals by providing internship opportunities within your organization. By participating, you will have the opportunity to:
        </p>
        <ul style="font-size: 16px; color: #555555; line-height: 1.5; padding-left: 20px;">
            <li>Engage with skilled and motivated students ready to contribute to your company’s goals.</li>
            <li>Enhance your organizational impact by nurturing future IT leaders.</li>
            <li>Collaborate with UCSC to foster industry-academia partnerships.</li>
        </ul>
        <p style="font-size: 16px; color: #555555; line-height: 1.5;">
            To register your company for this program, please click the button below:
        </p>
        <div style="text-align: center; margin: 20px 0;">
            <a href="[REGISTRATION_LINK]" style="display: inline-block; background-color: #0056b3; color: #ffffff; padding: 10px 20px; text-decoration: none; font-size: 16px; border-radius: 5px;">
                Register Now
            </a>
        </div>
        <p style="font-size: 16px; color: #555555; line-height: 1.5;">
            For any inquiries, feel free to contact us at <a href="mailto:contact@ucsc.cmb.ac.lk" style="color: #0056b3;">contact@ucsc.cmb.ac.lk</a>. We look forward to partnering with you.
        </p>
        <p style="font-size: 16px; color: #555555; line-height: 1.5;">Thank you,</p>
        <p style="font-size: 16px; color: #555555; line-height: 1.5;">
            Best regards,<br>
            UCSC Professional Development Center
        </p>
        <div style="background-color: #f2f2f2; padding: 10px; margin-top: 20px; text-align: center;">
            <p style="font-size: 14px; color: #777777;">
                &copy; 2024 University of Colombo School of Computing. All Rights Reserved.
            </p>
        </div>
    </div>
</body>
</html>
';

        $mail->Body    = $bodyContent;

        return $mail->send() ? "Success" : null;
    }
}
