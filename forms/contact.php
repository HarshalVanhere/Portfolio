<?php

  $receiving_email_address = 'harshalvanhere@gmail.com';

  // Check if the form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate and sanitize input data
    $from_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $from_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if (!$from_name || !$from_email || !$subject || !$message) {
      die('Invalid input.');
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
    die('Invalid request method.');
  }

?>
