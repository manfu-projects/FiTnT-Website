<?php
    session_start();
    include 'role/conn.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['trainer_id'])) {
        $member_id = $_SESSION['member_id']; 
        $trainer_id = $_POST['trainer_id'];

        if (isset($member_id) && isset($trainer_id)) {
            $sql = "INSERT INTO trainer_request_table (member_id, trainer_id, request_date) VALUES (?, ?, CURRENT_TIMESTAMP)";
            $stmt = $dbConn->prepare($sql);
            $stmt->bind_param("ii", $member_id, $trainer_id);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Trainer request submitted successfully.";
            } else {
                $_SESSION['error_message'] = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $_SESSION['error_message'] = "Invalid request.";
        }

        $dbConn->close();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    $sql = "SELECT * FROM user WHERE user_role = 'trainer'";
    $result = $dbConn->query($sql);

    $trainers = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $trainers[] = $row;
        }
    }

    $success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
    $error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';

    unset($_SESSION['success_message']);
    unset($_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Trainer</title>
    <link rel="stylesheet" href="CSS/m-find-trainer.css">
</head>
<body>
    <div class="container">
        <div class="heading">
            <?php include 'heading-member/heading-member.php'; ?>
        </div>
        <main class="content">
            <h2 class="page-title">Trainers Available</h2>
            <div class="trainer-section">
                <?php if (isset($success_message)): ?>
                    <p class="success-message" id="successMessage"><?php echo $success_message; ?></p>
                <?php endif; ?>
                <?php if (isset($error_message)): ?>
                    <p class="error-message" id="errorMessage"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <?php foreach ($trainers as $trainer): ?>
                    <div class="trainer">
                        <div class="request-trainer">
                            <img src="<?php echo htmlspecialchars($trainer['profile_photo']); ?>" alt="Trainer <?php echo htmlspecialchars($trainer['username']); ?>">
                            <form method="POST" action="">
                                <input type="hidden" name="trainer_id" value="<?php echo $trainer['user_id']; ?>">
                                <button type="submit" class="action-button">Request Trainer</button>
                            </form>
                        </div>
                        <div class="trainer-info">
                            <p><span>Name:</span> <?php echo htmlspecialchars($trainer['username']); ?></p>
                            <p><span>Location:</span> ABC</p>
                            <p><span>Contact:</span> <?php echo htmlspecialchars($trainer['contact_num']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if ("<?php echo isset($_GET['success_message']) ? $_GET['success_message'] : ''; ?>") {
                document.getElementById("jobForm").reset();
            }

            const successMessage = document.getElementById("successMessage");
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = "none";
                }, 3000);
            }

            const errorMessage = document.getElementById("errorMessage");
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.display = "none";
                }, 3000);
            }
        });
    </script>
</body>
</html>
