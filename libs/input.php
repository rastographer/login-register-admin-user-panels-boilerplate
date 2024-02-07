<?php

class Input
{
    public static function sanitizeString($input)
    {
        // Remove HTML and PHP tags
        $sanitized = strip_tags($input);

        // Remove leading and trailing whitespaces
        $sanitized = trim($sanitized);

        // Convert special characters to HTML entities
        $sanitized = htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');

        return $sanitized;
    }

    public static function sanitizeEmail($email)
    {
        // Sanitize and validate email address
        $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        $sanitizedEmail = filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL);

        return $sanitizedEmail;
    }

    // Add more methods for different types of input if needed

     // Sanitize Kenyan number for Mpesa
     public static function sanitizePhone($phone) {
        // Remove all non-digit characters
        $phone = preg_replace('/\D/', '', $phone);

        // Check if the number starts with '0' or '+254' and adjust accordingly
        if (strlen($phone) == 9) {
            // If it's a 9-digit number, prepend '254'
            $phone = '254' . $phone;
        } elseif (substr($phone, 0, 3) == '254') {
            // If it starts with '254', remove any '+' sign
            $phone = '254' . substr($phone, 3);
        }

        // Ensure the final format is (254xxxxxxxxx)
        $phone = '254' . substr($phone, -9);

        return $phone;
    }

    public static function escapeOutput($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}

?>