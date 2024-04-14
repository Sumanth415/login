<?php 
$email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'db1');
    if ($conn->connect_error) {
        die("Connection Failed : " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT * FROM registration WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if ($data['password'] === $password) {
                echo "<h2>Login successful!</h2>";
                // You can redirect the user to another page after successful login if needed
            } else {
                echo "<h2>Invalid email or password</h2>";
            }
        } else {
            echo "Invalid email or password";
        }
        $stmt->close();
        $conn->close();
    }
?>