<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"]=== "POST") {
    $name = trim($_POST["name"]);
    $age = $_POST["age"];
    $email = trim($_POST["email"]);

    if (!empty($name) && !empty($age) && !empty($email)) {
        $sql = "INSERT INTO students (name,age,email)
        values (?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $age, $email]);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add student</title>
</head>
<body>
    <h1>Add New Student</h1>
    <form  method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="age">Age:</label>
        <input type="number" name="age" id="age" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <input type="submit" value="Add Student">
    </form>
    <br>
    <a href="index.php">Back to Dashboard</a>
</body>
</html>