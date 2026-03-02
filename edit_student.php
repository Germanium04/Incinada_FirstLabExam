<?php
include 'db.php';
$message = "";

$result = mysqli_query($conn, "SELECT id, name, email, course FROM info");
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email     = $_POST['email'];
    $course = $_POST['course'];

  if ($id == "" || $name == "" || $email == "") {
    $message = "ID, Name, and Email are required!";
  } else {
    $sql = "UPDATE students SET id='$id', name='$name', email='$email', course='$course' WHERE id=$id";
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
    <h2>Edit Student Record</h2>
    <form action="edit_student.php" method="POST">
        <?php if ($message): ?>
            <div class="error-msg"><?php echo $message; ?></div>
        <?php endif; ?>s
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>
        <?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?><br><br>
        
        <label for="course">Course:</label>
        <input type="text" id="course" name="course" required>
        <?php echo isset($_POST['course']) ? $_POST['course'] : ''; ?><br><br>
        
        <input type="submit" value="Save Student" name="edit">
</body>
</html>