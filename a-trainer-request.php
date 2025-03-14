<?php
    session_start();
    include 'role/conn.php';

    $sql = "SELECT * FROM trainer_request_table";
    $result = $dbConn->query($sql);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $request_id = $_POST['request_id'];

        if (isset($_POST['remove_member'])) {
            $sql = "SELECT member_id, trainer_id FROM trainer_request_table WHERE request_id = $request_id";
            $request_result = $conn->query($sql);
            if ($request_result->num_rows > 0) {
                $row = $request_result->fetch_assoc();
                $member_id = $row['member_id'];
                $trainer_id = $row['trainer_id'];
                
                $sql = "INSERT INTO trainer_assign_table (member_id, trainer_id) VALUES ($member_id, $trainer_id)";
                if ($dbConn->query($sql) === TRUE) {
                    $sql = "DELETE FROM trainer_request_table WHERE request_id = $request_id";
                    if ($dbConn->query($sql) === TRUE) {
                        echo "Member assigned to trainer and request removed successfully.";
                    } else {
                        echo "Error removing request: " . $dbConn->error;
                    }
                } else {
                    echo "Error assigning member to trainer: " . $dbConn->error;
                }
            } else {
                echo "Invalid request.";
            }
        }

        if (isset($_POST['remove_request'])) {
            $sql = "DELETE FROM trainer_request_table WHERE request_id = $request_id";
            if ($dbConn->query($sql) === TRUE) {
                echo "Request removed successfully.";
            } else {
                echo "Error removing request: " . $dbConn->error;
            }
        }

        $dbConn->close();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Request</title>
    <link rel="stylesheet" href="CSS/a-trainer-request.css">
</head>
<body>
    <div class="container">
        <div class="heading">
            <?php include 'heading-admin/heading-admin.php'; ?>
        </div>
        <main class="content">
            <h2 class="page-title">Trainer Request</h2>
            <div class="table-container">
                <table class="request-table">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Member ID</th>
                            <th>Trainer ID</th>
                            <th>Request Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['request_id']}</td>
                                    <td>{$row['member_id']}</td>
                                    <td>{$row['trainer_id']}</td>
                                    <td>{$row['request_date']}</td>
                                    <td>
                                        <form method='post' action=''>
                                            <input type='hidden' name='request_id' value='" . $row['request_id'] . "'>
                                            <button type='submit' name='remove_member' class='action-button remove-member'>Approve</button>
                                            <button type='submit' name='remove_request' class='action-button remove-request'>Remove</button>
                                        </form>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No requests found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
