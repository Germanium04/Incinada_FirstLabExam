<?php
include 'db.php';

$result = mysqli_query($conn, "SELECT id, name, email, course FROM info");

if (isset($_GET['delete_id'])) {
    $del_id = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM info WHERE id=$del_id");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Student Records</title>
    <script>
        function handleAction(select, studentId) {
            const action = select.value;
            if (action === "edit") {
                window.location.href = "edit_student.php?id=" + studentId;
            } else if (action === "delete") {
                if (confirm("Are you sure you want to delete this record?")) {
                    window.location.href = "index.php?delete_id=" + studentId;
                }
            }
            select.selectedIndex = 0;
        }
    </script>
</head>
<body>
    <h2>Student Records</h2>
    <button onclick="window.location.href='create_student.php'">Add Student</button>
            
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="records" style="border: 1px solid #ccc; margin: 10px; padding: 10px;">
            <select onchange="handleAction(this, '<?php echo $row['id']; ?>')">
                <option value="">Select Action</option>
                <option value="edit">Edit Student</option>
                <option value="delete">Delete Student</option>
            </select>
            <h2>ID: <?php echo $row['id']; ?></h2>
            <p>Name: <?php echo $row['name']; ?></p>   
            <p>Email: <?php echo $row['email']; ?></p>
            <p>Course: <?php echo $row['course']; ?></p>
    </div>
    <?php } ?>
    <button onclick="window.location.href='login.php'">Logout</button>
</body>
</html>