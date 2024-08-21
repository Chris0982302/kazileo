<?php
// Configuration file
require_once('config.php');

// Initialize variables
$servername = 'localhost';
$username = '';
$password = '';
$dbname = ''; // add this variable
$errors = array();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registration_number = $_POST["registration_number"];
    $password = $_POST["password"];

    // Validate input
    if (empty($registration_number)) {
        $errors[] = "Registration number is required";
    } elseif (!preg_match("/^[A-Za-z0-9]{5,20}$/", $registration_number)) {
        $errors[] = "Invalid registration number format (must be 5-20 characters, alphanumeric)";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
        $errors[] = "Invalid password format (must be at least 8 characters, contain at least one letter and one number)";
    }

    // Check if there are no errors
    if (count($errors) == 0) {
       
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to check if user exists
        $query = "SELECT * FROM users WHERE registration_number = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $registration_number, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists, login successful
            session_start();
            $_SESSION["registration_number"] = $registration_number;
            header('Location: voting.php');
            exit;
        } else {
            $errors[] = "Invalid registration number or password";
        }

        $stmt->close();
        $conn->close();
    }
}

// Display errors
if (count($errors) > 0) {
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
}
?>

<!-- HTML form -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="registration_number">Registration Number:</label>
    <input type="text" id="registration_number" name="registration_number"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>