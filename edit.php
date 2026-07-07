<?php
require "db.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

//fetch student

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("Student not found");
}

// update student
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $age = $_POST['age'];
    $email = trim($_POST['email']);

    if(!empty($name) && !empty($age) && !empty($email)) {
        $sql = "UPDATE students SET name = ?, age = ?, email = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $age, $email, $id]);
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
    <title>Edit student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <div class="card">
    <h1>Edit Student</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>
        <label>Age:</label>
        <input type="number" name="age" value="<?php echo htmlspecialchars($student['age']); ?>" required>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
        <div style="margin-top:14px">
            <input class="btn primary" type="submit" value="Update Student">
            <a class="btn ghost" href="index.php">Back</a>
        </div>
    </form>
    </div>
    </div>
</body>
</html>