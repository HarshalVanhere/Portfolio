<?php

  $receiving_email_address = 'harshalvanhere@gmail.com';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate and sanitize input data
    $from_name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $from_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars(strip_tags(trim($_POST['subject'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    if (!$from_name || !$from_email || !$subject || !$message) {
      echo "Invalid input. Please ensure all fields are filled out correctly.";
      exit;
    }

    // Create email headers
    $headers = "From: $from_name <$from_email>\r\n";
    $headers .= "Reply-To: $from_email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Prepare the email content
    $email_content = "Name: $from_name\n";
    $email_content .= "Email: $from_email\n\n";
    $email_content .= "Message:\n$message\n";

    // Send the email
    if (mail($receiving_email_address, $subject, $email_content, $headers)) {
      echo "Your message has been sent. Thank you!";
    } else {
      echo "Failed to send your message. Please try again later.";
    }
  } else {
    echo 'Invalid request method.';
    exit;
  }

?>