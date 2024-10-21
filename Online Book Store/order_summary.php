<?php
session_start();
require_once 'db_connection.php'; // Make sure this path is correct

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['username']; // Get the logged-in user's username

// Fetch orders for the user
$query = "SELECT * FROM orders WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file if needed -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
        }
        .button-group button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-home {
            background-color: #28a745;
            color: white;
        }
        .btn-logout {
            background-color: #dc3545;
            color: white;
        }
        .btn-home:hover, .btn-logout:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Order Summary for <?php echo htmlspecialchars($username); ?></h1>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Items</th>
                    <th>Total Price</th>
                    <th>Received Date</th>
                    <th>Delivery Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['ordered_items']); ?></td>
                            <td>$<?php echo $row['total_price']; ?></td>
                            <td><?php echo $row['order_received_date']; ?></td>
                            <td><?php echo $row['order_delivery_date']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="button-group">
            <button class="btn-home" onclick="window.location.href='index.php'">Go to Home</button>
            <form action="logout.php" method="POST" style="margin: 0;">
                <button type="submit" class="btn-logout">Log Out</button>
            </form>
        </div>
    </div>
</body>

</html>
<?php
// order_confirmation.php (or wherever the order is processed)

// Start the session
// session_start();
// require_once 'db_connection.php';

// Assume the order logic is handled here



$stmt->close();
$conn->close();
?>
