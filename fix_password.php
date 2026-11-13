<?php
require_once 'dbConnect.php';

// 1. Ensure the Password column can store full 255-char bcrypt hashes
$pdo->exec("ALTER TABLE `Staff` MODIFY `Password` VARCHAR(255) NOT NULL");

// 2. Hash your password properly using PHP
$email = 'bynnshiuantan@gmail.com';
$password = 'Tbs071022';
$hash = password_hash($password, PASSWORD_DEFAULT);

// 3. Update the database record
$stmt = $pdo->prepare("UPDATE `Staff` SET `Password` = ? WHERE `Email` = ?");
$stmt->execute([$hash, $email]);

if ($stmt->rowCount() > 0) {
    echo "<h2 style='color:green;'>Password updated successfully!</h2>";
    echo "<p>Staff account <strong>$email</strong> is now ready.</p>";
    echo "<p><a href='login.php' style='padding:8px 16px; background:#16a085; color:#fff; text-decoration:none; border-radius:4px;'>Go to Login Page</a></p>";
} else {
    echo "<h2 style='color:red;'>No row updated.</h2>";
    echo "<p>Check if <code>$email</code> exists in your <code>Staff</code> table.</p>";
}
?>