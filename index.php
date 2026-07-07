<?php
require "db.php";
$sql = "SELECT * FROM students ORDER BY id DESC";
$stmt = $pdo->query($sql);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <div class="card">
    <h1>Student Management Dashboard</h1>
    <div class="toolbar">
        <div class="muted">Manage your student records quickly and easily.</div>
        <div><a class="btn primary" href="add.php">Add New Student</a></div>
    </div>
    <table class="students">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

         <?php foreach ($students as $student): ?>
         <tr>
         <td><?= $student['id']; ?></td>
         <td><?= htmlspecialchars($student['name']); ?></td>
         <td><?= $student['age']; ?></td>
         <td><?= htmlspecialchars($student['email']); ?></td>
         <td><?= $student['created_at']; ?></td>
         <td class="actions">
             <a class="btn ghost" href="edit.php?id=<?= $student['id']; ?>">Edit</a>
             <a class="btn danger" href="delete.php?id=<?= $student['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
         </tr>
         <?php endforeach; ?>
         </tbody>
    </table>
    </div>
    </div>
</body>
</html>