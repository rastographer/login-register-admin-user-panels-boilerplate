<?php

class Functions
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Sanitize phone number [Kenya]
    public function sanitizePhone($phone) {
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


    // Function to escape HTML entities in a given string
    public function escapeOutput($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    public static function sanitizeInput($input)
    {
        // Remove HTML and PHP tags
        $sanitized = strip_tags($input);

        // Remove leading and trailing whitespaces
        $sanitized = trim($sanitized);

        // Convert special characters to HTML entities
        $sanitized = htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');

        return $sanitized;
    }

    public function getSetting($key)
    {
        $sql = "SELECT setting_value FROM site_settings WHERE setting_key = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $key);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row['setting_value'];
        }

        return null;
    }
    
    public function getAdmin($username)
    {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $username);

        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_object();

        return $admin;
    }

    public function getUser($email)
    {
        $role = "user";
        $query = "SELECT * FROM users WHERE email = ? AND role = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $email, $role);

        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object();

        return $user;
    }

    public function getUserById($user_id)
    {
        $role = "user";
        $query = "SELECT * FROM users WHERE id = ? AND role = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $user_id, $role);

        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object();

        return $user;
    }
    
    public function getAllUsers()
    {
        $users = array();
    
        $result = $this->conn->query("SELECT * FROM users WHERE role = 'user' ORDER BY created_at DESC");
        
        if (!$result) {
            die('Error: ' . $this->conn->error);
        }
    
        while ($row = $result->fetch_object()) {
            $users[] = (object)$row; // Ensure each row is cast to an object
        }
    
        return $users;
    }

    
    //get number users
    public function getNumUsers()
    {
        $result = $this->conn->query("SELECT COUNT(*) as count FROM users");
        $data = $result->fetch_assoc();
        return isset($data['count']) ? (int)$data['count'] : 0;
    }

    public function updateSetting($key, $value)
    {
        $sql = "UPDATE site_settings SET setting_value = ? WHERE setting_key = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $value, $key);

        return $stmt->execute();
    }


}