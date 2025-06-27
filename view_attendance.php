<?php
$conn = new mysqli("localhost", "root", "root", "attendance");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT vendor_name, department, date, in_time, out_time, status FROM attendance ORDER BY date DESC, in_time ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vendor Attendance Records</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #ffe0c3, #ffb3a7);
            margin: 0;
            padding: 20px;
        }

        header {
            text-align: center;
            padding: 20px;
            background-color: #e67e22;
            color: white;
            font-size: 26px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        table {
            width: 95%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f39c12;
            color: white;
        }

        tr:hover {
            background-color: #fdf2e9;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #d35400;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <header>Vendor Attendance Records</header>

    <table>
        <tr>
            <th>Vendor Name</th>
            <th>Department</th>
            <th>Date</th>
            <th>In Time</th>
            <th>Out Time</th>
            <th>Status</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["vendor_name"]) . "</td>
                        <td>" . htmlspecialchars($row["department"]) . "</td>
                        <td>" . $row["date"] . "</td>
                        <td>" . $row["in_time"] . "</td>
                        <td>" . $row["out_time"] . "</td>
                        <td>" . $row["status"] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6' style='text-align:center;'>No attendance records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>

    <a class="back-link" href="index.html">⬅ Back to Mark Attendance</a>
</body>
</html>