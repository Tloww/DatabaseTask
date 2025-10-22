<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'tala';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) { die('Connection failed: '.$conn->connect_error); }
$conn->set_charset('utf8mb4');

if (isset($_GET['toggle_id'])) {
  $id = (int)$_GET['toggle_id'];
  $stmt = $conn->prepare('UPDATE users SET status = 1 - status WHERE id = ?');
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $stmt->close();
  header('Location: test.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = isset($_POST['name']) ? trim($_POST['name']) : '';
  $age  = isset($_POST['age'])  ? (int)$_POST['age']     : 0;
  if ($name !== '' && $age > 0) {
    $stmt = $conn->prepare('INSERT INTO users (name, age) VALUES (?, ?)');
    $stmt->bind_param('si', $name, $age);
    $stmt->execute();
    $stmt->close();
  }
  header('Location: test.php');
  exit;
}

$res = $conn->query('SELECT id, name, age, status FROM users ORDER BY id ASC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Users</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
  :root{--primary:#0d6efd;--bg:#f8f9fa;--card:#fff;--muted:#6c757d}
  body{font-family:Segoe UI,Arial,sans-serif;background:var(--bg);margin:32px}
  h2{margin:0 0 14px}
  .card{background:var(--card);padding:18px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.1);margin-bottom:20px}
  input{padding:8px 10px;margin-right:8px;border:1px solid #ccc;border-radius:6px}
  button{padding:8px 16px;background:var(--primary);color:#fff;border:none;border-radius:6px;cursor:pointer}
  button:hover{opacity:.9}
  table{width:100%;border-collapse:collapse;margin-top:20px}
  th,td{padding:12px;text-align:center;border-bottom:1px solid #eee}
  th{background:var(--primary);color:#fff}
  a.toggle{padding:6px 12px;background:#198754;color:#fff;text-decoration:none;border-radius:6px}
  a.toggle:hover{opacity:.9}
  .status0{color:red;font-weight:bold}
  .status1{color:green;font-weight:bold}
</style>
</head>
<body>
<div class="card">
  <h2>Add New User</h2>
  <form method="POST">
    <input type="text" name="name" placeholder="Enter name" required>
    <input type="number" name="age" placeholder="Enter age" required>
    <button type="submit">Submit</button>
  </form>
</div>

<div class="card">
  <h2>Users Table</h2>
  <table>
    <tr>
      <th>ID</th><th>Name</th><th>Age</th><th>Status</th><th>Action</th>
    </tr>
    <?php while($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= $row['age'] ?></td>
        <td class="status<?= $row['status'] ?>"><?= $row['status'] ?></td>
        <td><a class="toggle" href="?toggle_id=<?= $row['id'] ?>">Toggle</a></td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>
