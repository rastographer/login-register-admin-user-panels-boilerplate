<?php
class User
{
    public $id;
    public $fullName;
    public $email;
    public $whatsappNumber;
    public $password;

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function register($fullName, $username, $email, $whatsappNumber, $password, $confirmPassword, $status)
    {
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
        }
    
        // Check if passwords match
        if ($password !== $confirmPassword) {
            return json_encode(['status' => 'error', 'message' => 'Passwords do not match.']);
        }
    
        // Prepare a single statement for checking email, phone, and username
        $checkSql = "SELECT COUNT(*) FROM users WHERE (email = ? OR phone = ? OR username = ?)";
        $checkStmt = $this->conn->prepare($checkSql);
    
        // Bind parameters for email, phone, and username
        $emailParam = $email;
        $phoneParam = $whatsappNumber;
        $usernameParam = $username;
        $checkStmt->bind_param("sss", $emailParam, $phoneParam, $usernameParam);
    
        // Execute the prepared statement
        $checkStmt->execute();
    
        // Get the result
        $result = $checkStmt->get_result();
    
        // Check if any data exists
        $dataExists = $result->fetch_assoc()['COUNT(*)'] > 0;
    
        // Close the statement
        $checkStmt->close();
    
        // Continue with registration if data doesn't exist
        if (!$dataExists) {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Set user role
            $role = 'user';
    
            // Prepare SQL statement for inserting user data
            $sql = "INSERT INTO users (role, full_name, username, email, phone, password, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
    
            // Bind parameters for user data
            $stmt->bind_param("sssssss", $role, $fullName, $username, $email, $whatsappNumber, $hashedPassword, $status);
    
            // Execute the insertion statement
            $stmt->execute();
    
            // Check for successful insertion
            if ($stmt->affected_rows === 1) {
                // Set user information
                $this->id = $this->conn->insert_id;
                $this->fullName = $fullName;
                $this->email = $email;
                $this->whatsappNumber = $whatsappNumber;
    
                // Close the statement
                $stmt->close();
    
                // Return success message
                return json_encode(['status' => 'success', 'message' => 'Registration successful.']);
            } else {
                // Close the statement
                $stmt->close();
    
                // Return error message
                return json_encode(['status' => 'error', 'message' => 'Registration failed.']);
            }
        } else {
            // Return error message for existing data
            return json_encode(['status' => 'error', 'message' => 'Email, phone, or username already exists.']);
        }
    }
    

    public function login($email, $password)
    {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
        }

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            return json_encode(['status' => 'error', 'message' => 'User not found.']);
        } else {

            if (!password_verify($password, $user["password"])) {
               return json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
            } else {
                $this->id = $user["id"];
                $this->fullName = $user["full_name"];
                $this->email = $user["email"];
                $this->whatsappNumber = $user["whatsapp_number"];
    
                $stmt->close();
                return json_encode(['status' => 'success', 'message' => 'Login successful.']);
            }

        }
       
    }

    public function passwordReset($email)
    {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
        }

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            return json_encode(['status' => 'error', 'message' => 'User not found.']);
        } else {
            // Generate password reset token
            //$token = md5(uniqid());
            $token = substr(md5(uniqid()), 0, 6);

            $sql = "INSERT INTO password_resets (user_id, token) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("is", $user["id"], $token);
            $stmt->execute();

            if ($stmt->affected_rows === 1) {
                // Send password reset email

                $stmt->close();
                return json_encode(['status' => 'success', 'message' => 'Password reset code has been sent to your email address.', 'data' => $token]);
            } else {
                $stmt->close();
                return json_encode(['status' => 'error', 'message' => 'Failed to send password reset code.']);
            }
        }       

    }

    public function verifyResetPasswordCode($token, $newPassword, $confirmPassword)
    {

        if ($newPassword !== $confirmPassword) {
            return json_encode([
                'status' => 'error',
                'message' => 'Passwords do not match.'
            ]);
        }

        $sql = "SELECT * FROM password_resets WHERE token = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $reset = $result->fetch_assoc();

        if (!$reset) {
            return json_encode([
                'status' => 'error',
                'message' => 'Invalid or expired reset code.'
            ]);
        }

        $expiredAt = strtotime($reset['created_at']) + 3600; // 1 hour expiration
        if (time() > $expiredAt) {
            return json_encode([
                'status' => 'error',
                'message' => 'Password reset code has expired.'
            ]);
        }

        $userId = $reset['user_id'];

        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update user password
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $hashedPassword, $userId);
        $stmt->execute();

        if ($stmt->affected_rows === 1) {
            // Delete used reset code
            $sql = "DELETE FROM password_resets WHERE token = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $token);
            $stmt->execute();

            return json_encode([
                'status' => 'success',
                'message' => 'Password updated successfully. Please login to continue.'          
            ]);
        } else {
            return json_encode([
                'status' => 'error',
                'message' => 'Password update failed. Please try again.'
            ]);
        }
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

    public function greetingBasedOnTimezone($user) {
        // Get the current time and user's timezone
        $currentTime = new DateTime('now');
        $userTimezone = new DateTimeZone(date_default_timezone_get());
        $currentTime->setTimezone($userTimezone);
      
        // Determine the greeting based on the hour
        $hour = $currentTime->format('H');
        if ($hour < 12) {
          $greeting = 'Good Morning, ' . $user;
        } elseif ($hour < 18) {
          $greeting = 'Good Afternoon, ' . $user;
        } else {
          $greeting = 'Good Evening, ' . $user;
        }
      
        // Return the greeting
        return $greeting;
      }

    public function editProfile($userId, $fullName, $username, $phoneNumber, $password)
    {
        // Validate user ID
        if (!is_numeric($userId)) {
            return json_encode(['status' => 'error', 'message' => 'Invalid user ID.']);
        }

        // Initialize arrays to store SET and parameters
        $setStatements = [];
        $params = [];

        // Hash the password if provided
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $setStatements[] = "password = ?";
            $params[] = $hashedPassword;
        }

        // Check if other fields are provided and update accordingly
        if (!empty($fullName)) {
            $setStatements[] = "full_name = ?";
            $params[] = $fullName;
        }

        if (!empty($username)) {
            $setStatements[] = "username = ?";
            $params[] = $username;
        }

        if (!empty($phoneNumber)) {
            $setStatements[] = "phone = ?";
            $params[] = $phoneNumber;
        }

        // Prepare SQL statement for updating user data
        $sql = "UPDATE users SET " . implode(", ", $setStatements) . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters for user data
        $paramTypes = str_repeat('s', count($params)) . 'i'; // 'sssi' for example
        $params[] = $userId;  // Add userId as a separate parameter
        $stmt->bind_param($paramTypes, ...$params);

        // Execute the update statement
        $stmt->execute();

        // Check for successful update
        if ($stmt->affected_rows === 1) {
            // Update user information in the current object
            $this->id = $userId;
            if (!empty($fullName)) {
                $this->fullName = $fullName;
            }
            if (!empty($username)) {
                $this->username = $username;
            }
            if (!empty($phoneNumber)) {
                $this->whatsappNumber = $phoneNumber;
            }

            // Close the statement
            $stmt->close();

            // Return success message
            return json_encode(['status' => 'success', 'message' => 'Profile updated successfully.']);
        } else {
            // Close the statement
            $stmt->close();

            // Return error message
            return json_encode(['status' => 'error', 'message' => 'Profile update failed.']);
        }
    }

}
