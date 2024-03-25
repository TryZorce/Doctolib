<?php
require_once __DIR__ . "/../../views/register.php";

?>
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>
    <form action="/register" method="POST">
        <label>Name: <input type="text" name="name" required></label>
        <label>Firstname: <input type="text" name="firstname"></label>
        <label>Email: <input type="email" name="email" required></label>
        <label>Password: <input type="password" name="password" required></label>
        <button type="submit">Register</button>
    </form>
</body>

</html>