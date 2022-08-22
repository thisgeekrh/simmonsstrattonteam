<?php
 
// POST Request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // form fields and remove whitespace.
        $first_name = strip_tags(trim($_POST["first_name"]));
        $last_name = strip_tags(trim($_POST["last_name"]));
        $phone = filter_var(trim($_POST["phone"]), FILTER_SANITIZE_EMAIL);
        $email = trim($_POST["email"]);
        $comment = trim($_POST["comment"]);

        // Check sent to the mailer.
        if ( empty($first_name) OR empty($comment) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please fillup the form and try again.";
            exit;
        }

        // Set the recipient email address.
        $recipient = "admin@isellscre.com";

        // Set the email sub.
        $sub = "New Client Email From $name";

        // Build the email content.
        $email_content = "First Name: $first_name\n";
        $email_content .= "Last Name: $last_name\n\n";
        $email_content .= "Number: $phone\n\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Comment:\n$comment\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
		$okk = mail($recipient, $email_headers, $email_content);
        if ( $okk ) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your comment has been sent.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your comment.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>
