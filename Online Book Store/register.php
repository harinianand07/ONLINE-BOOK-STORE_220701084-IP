<?php  
// Start the session to manage user sessions
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Your username
$password = "harini07"; // Your password (empty string if no password)
$dbname = "bookify_1"; // Database name

// Create connection
$conn = new mysqli($servername,$username,$password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input data and sanitize
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO registered_users (username, password) VALUES (?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ss", $username, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        // Store a success message in session
        $_SESSION['message'] = "Registration successful! Please login.";
        // Redirect to login page
        header("Location: login.php");
        exit();
    } else {
        // Check for duplicate usernames
        if ($stmt->errno === 1062) {
            echo "Error: Username already exists. Please choose a different username.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close statement and connection
    $stmt->close();
}

// Close the connection when done
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.8); /* Translucent white */
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049; /* Darker green */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="register.php">
            Username:<br>
            <input type="text" name="username" placeholder="Username" required><br>
            Password:<br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
