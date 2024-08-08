<?php

if ($_POST) {
    $fname = "";
    $lname = "";
    $email = "";
    $subject = "";
    $body = "";
    $email_body = "<div>";

    if (isset($_POST['fname'])) {
        $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>First Name:</b></label>&nbsp;<span>" . $fname . "</span>
                        </div>";
    }

    if (isset($_POST['lname'])) {
        $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);  // Fixed variable assignment
        $email_body .= "<div>
                           <label><b>Last Name:</b></label>&nbsp;<span>" . $lname . "</span>
                        </div>";
    }

    if (isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Email:</b></label>&nbsp;<span>" . $email . "</span>
                        </div>";
    }

    if (isset($_POST['company'])) {
        $company = filter_var($_POST['company'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Company:</b></label>&nbsp;<span>" . $company . "</span>
                        </div>";
    }

    if (isset($_POST['subject'])) {
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Subject:</b></label>&nbsp;<span>" . $subject . "</span>
                        </div>";
    }

    if (isset($_POST['body'])) {
        $body = htmlspecialchars($_POST['body']);
        $email_body .= "<div>
                           <label><b>Body:</b></label>
                           <div>" . $body . "</div>  // Fixed missing concatenation operator
                        </div>";
    }

    $recipient = "travisbakerit@gmail.com";

    $email_body .= "</div>";

    $headers = 'MIME-Version: 1.0' . "\r\n"
        . 'Content-type: text/html; charset=utf-8' . "\r\n"
        . 'From: ' . $email . "\r\n";

    if (mail($recipient, $subject, $email_body, $headers)) {  // Use $email_body instead of $body
        echo "<p>Thank you for contacting, $fname. I will be in contact soon.</p>";
    } else {
        echo '<p>We are sorry but the email did not go through.</p>';
    }

} else {
    echo '<p>Something went wrong</p>';
}
?>
