<?php

namespace app\controllers;

use core\Controller;
// Step 2: Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactsController extends Controller
{

    public function index()
    {
        $view = 'contact';
        $data = [
            'pageTitle' => 'loream',
            'meta' => [
                'title' => "loream",
                'description' => "loream",
                'url' => 'https://www.lacasadecom.com/blogs',
                'image' => 'assets/images/'
            ]
        ];
        $this->render($view, $data);
    }
    public function handleContact()
    {
        session_start();
        // Process form data (ensure method is POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Collect form data
            $fullname = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $name = $_POST['name'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            // Step 3: Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            try {



                // Server settings
                $mail->isSMTP(); // Use SMTP
                $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'boudafdafayoub@gmail.com'; // Your Gmail address
                $mail->Password = 'cqsw ppkz hbmq yovo'; // Your Gmail App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
                $mail->Port = 587; // SMTP port for TLS

                // Enable verbose debug output (set to 0 for production)
                $mail->SMTPDebug = 0;

                // Recipients
                $mail->setFrom('mrjabal@scalax.co', $fullname); // Sender
                $mail->addAddress('mrjabal@scalax.co'); // Replace with your email address

                // Content
                $mail->isHTML(true); // Use plain text
                $mail->Subject = "Client lacasadecom : $fullname";
                $mail->Body    = "<b>Nom et prenom :</b> $fullname<br><br><b>Email :</b>  $email<br><br><b>Phone :</b> $phone<br><br> <b>subject :</b> $subject<br><br> <b>message :</b> $message  ";

                // Step 7: Send the email

                if ($mail->send()) {
                    $_SESSION['status']  = true; // Store success or failure status
                    $_SESSION['message'] =  "Votre message a été envoyé avec succès !";
                    $_SESSION['message_time'] = time(); // Store the current timestamp
                } else {
                    $_SESSION['status'] = false; // Store success or failure status
                    $_SESSION['message'] = "Échec de l'envoi de votre message.";
                    $_SESSION['message_time'] = time(); // Store the current timestamp  
                }
                //  echo 'Message has been sent successfully!';


            } catch (Exception $e) {

                // Catch any exceptions and set an error message
                $_SESSION['status'] = false;
                $_SESSION['message'] = "Error: ";
                $_SESSION['message_time'] = time(); // Store the timestamp
            }


            $view = 'home';
            $data = [];  // Example data to pass
            $this->render($view, $data);
        } else {

            $_SESSION['status'] = false;
            $_SESSION['message'] = "Error: ";
            $_SESSION['message_time'] = time(); // Store the timestamp


            $view = 'home';

            $data = ['error' => 'error'];  // Example data to pass
            $this->render($view, $data);
            exit;
        }
    }


    //this for landing page
    public function handleLandingContact($viewLanding)
    {
        session_start();
        // Process form data (ensure method is POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Collect form data
            $fullname = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            // Step 3: Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            try {



                // Server settings
                $mail->isSMTP(); // Use SMTP
                $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'boudafdafayoub@gmail.com'; // Your Gmail address
                $mail->Password = 'cqsw ppkz hbmq yovo'; // Your Gmail App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
                $mail->Port = 587; // SMTP port for TLS

                // Enable verbose debug output (set to 0 for production)
                $mail->SMTPDebug = 0;

                // Recipients
                $mail->setFrom('mrjabal@scalax.co', $fullname); // Sender
                $mail->addAddress('mrjabal@scalax.co'); // Replace with your email address

                // Content
                $mail->isHTML(true); // Use plain text
                $mail->Subject = "Client lacasadecom : $viewLanding";
                $mail->Body    = "<b>Nom et prenom :</b> $fullname<br><br><b>Email :</b>  $email<br><br><b>Phone :</b> $phone<br><br> <b>subject :</b> $subject<br><br> <b>message :</b> $message  ";

                // Step 7: Send the email

                if ($mail->send()) {
                    $_SESSION['status']  = true; // Store success or failure status
                    $_SESSION['message'] =  "Votre message a été envoyé avec succès !";
                    $_SESSION['message_time'] = time(); // Store the current timestamp
                } else {
                    $_SESSION['status'] = false; // Store success or failure status
                    $_SESSION['message'] = "Échec de l'envoi de votre message.";
                    $_SESSION['message_time'] = time(); // Store the current timestamp  
                }
                //  echo 'Message has been sent successfully!';


            } catch (Exception $e) {

                // Catch any exceptions and set an error message
                $_SESSION['status'] = false;
                $_SESSION['message'] = "Error: ";
                $_SESSION['message_time'] = time(); // Store the timestamp
            }
            echo json_encode($_SESSION);
            exit;
        } else {

            $_SESSION['status'] = false;
            $_SESSION['message'] = "Error: ";
            $_SESSION['message_time'] = time(); // Store the timestamp


            echo json_encode($_SESSION);
            exit;
        }
    }
}
