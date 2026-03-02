<?php
include 'db.php';
$message = "";

if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email     = $_POST['email'];
    $course = $_POST['course'];

  if ($id == "" || $name == "" || $email == "") {
    $message = "ID, Name, and Email are required!";
  } else {
    $sql = "INSERT INTO info (id, name, email, course)
            VALUES ('$id', '$name', '$email', '$course')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit;
  }
}
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
    <h2>Create Student Record</h2>
    <form action="create_student.php" method="POST">
        <?php if ($message): ?>
            <div class="error-msg"><?php echo $message; ?></div>
        <?php endif; ?>
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" required><br><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="course">Course:</label>
            <input type="text" id="course" name="course" required><br><br>
            
            <input type="submit" value="Add Student" name="save">
            <input type="submit" value="Cancel" onclick="window.location.href='index.php'">
</body>
</html>