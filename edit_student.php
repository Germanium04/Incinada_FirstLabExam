<?php
include 'db.php';
$message = "";
$student = ['ID' => '', 'name' => '', 'email' => '', 'course' => ''];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $fetch_sql = "SELECT * FROM info WHERE ID = $id"; 
    $res = mysqli_query($conn, $fetch_sql);
    
    if ($res && mysqli_num_rows($res) > 0) {
        $student = mysqli_fetch_assoc($res);
    } else {
        $message = "Student record not found.";
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id']; 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    if ($id == "" || $name == "" || $email == "") {
        $message = "All fields are required!";
    } else {
        $sql = "UPDATE info SET name='$name', email='$email', course='$course' WHERE ID=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit;
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student Record</h2>
    <form action="edit_student.php" method="POST">
        <?php if ($message): ?>
            <div class="error-msg" style="color: red;"><?php echo $message; ?></div>
        <?php endif; ?>

        <label for="id">ID:</label>
        <input type="text" id="id" name="id" value="<?php echo $student['ID']; ?>" readonly><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>" required><br><br>
        
        <label for="course">Course:</label>
        <input type="text" id="course" name="course" value="<?php echo $student['course']; ?>" required><br><br>
        
        <input type="submit" value="Update Student" name="edit">
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>