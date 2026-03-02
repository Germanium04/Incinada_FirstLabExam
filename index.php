<?php
include 'db.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT id, name, email, course FROM info");
$delete = mysqli_query($conn, "DELETE FROM info WHERE id=$id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Student Records</h2>
    <button onclick="window.location.href='create_student.php'">Add Student</button>
            
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <div class="records">
                <select id="studentActions" onchange="handleAction(this)">
                    <option value="edit">Edit Student</option>
                    <option value="delete">Delete Student</option>
                </select>
                <h2><?php echo $row['id']; ?></h2>
                <p><?php echo $row['name']; ?></p>   
                <p><?php echo $row['email']; ?></p>
                <p><?php echo $row['course']; ?></p>
        </div>
        <?php } ?>
    <button onclick="window.location.href='login.php'">Logout</button>
</body>
</html>