<?php
$conn = new mysqli("localhost", "root", "root", "attendance");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$vendor_name = $_POST['vendor_name'];
$department = $_POST['department'];
$date = $_POST['date'];
$in_time = $_POST['in_time'];
$out_time = $_POST['out_time'];
$status = $_POST['status'];

// Insert record
$sql = "INSERT INTO attendance (vendor_name, department, date, in_time, out_time, status)
        VALUES ('$vendor_name', '$department', '$date', '$in_time', '$out_time', '$status')";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance Status</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #c2e9fb, #a1c4fd);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }

        .message-box {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            text-align: center;
            max-width: 400px;
        }

        .message-box h2 {
            color: #2c3e50;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #2980b9;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <?php
        if ($conn->query($sql) === TRUE) {
            echo "<h2>✅ Attendance marked for <strong>" . htmlspecialchars($vendor_name) . "</strong>.</h2>";
        } else {
            echo "<h2>❌ Error: " . $conn->error . "</h2>";
        }
        $conn->close();
        ?>
        <a class="back-link" href="index.html">⬅ Back to Portal</a>
    </div>
</body>
</html>