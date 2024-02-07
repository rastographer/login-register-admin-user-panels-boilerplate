<?php

session_start();
include __DIR__ . '/db.php';

// Import the mailer.php class
include '../libs/mailer.php'; // mailer class

if(isset($_POST['userEmail'])){
        // Get data from the POST request
        $userEmail = $_POST['userEmail'];
        $itemDetails = $_POST['itemDetails'];
        
        // Additional data that can be obtained from your dashboard.php
        $userFullName = $_POST['userFullName']; // $_POST['itemName'] // user's full name
        $itemName = $_POST['itemName']; // item name
        $itemPrice = $_POST['itemPrice']; // Replace with the actual item price

        // Data array for the email template
        $emailData = [
            'to' => $userEmail,
            'subject' => 'Remo Account Details',
            'template' => 'purchase_email_template',
            'userFullName' => $userFullName,
            'itemName' => $itemName,
            'itemPrice' => $itemPrice,
            'itemDetails' => $itemDetails
        ];

        // Send the email
        if (send_mail($emailData)) {
            // Return success response
            echo json_encode(['status' => 'success', 'message' => 'Email sent successfully!']);
        } else {
            // Return error response
            echo json_encode(['status' => 'error', 'message' => 'Error sending email']);
        }
    } else {
        // Return error response
        echo json_encode(['status' => 'error', 'message' => 'Ajax issue']);
    }
    
    
    if(isset($_POST['clientEmail'])){
        // Get data from the POST request
        $userEmail = $_POST['clientEmail'];
        $itemDetails = $_POST['clientDetails'];
        $userFullName = $_POST['clientFullName'];

        // Data array for the email template
        $emailData = [
            'to' => $userEmail,
            'subject' => 'Status About Your BuyRemoTasksAccount',
            'template' => 'admin_message_template',
            'userFullName' => $userFullName,
            'itemDetails' => $itemDetails
        ];

        // Send the email
        if (send_mail($emailData)) {
            // Return success response
            echo json_encode(['status' => 'success', 'message' => 'Email sent successfully!']);
        } else {
            // Return error response
            echo json_encode(['status' => 'error', 'message' => 'Error sending email']);
        }
    } else {
        // Return error response
        echo json_encode(['status' => 'error', 'message' => 'Ajax issue']);
    }
?>
