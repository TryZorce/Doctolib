<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
</head>

<body>
    <h1>Profile</h1>
    <form action="/profile" method="POST">
        <label>Name: <input type="text" name="name"  required></label>
        <label>Firstname: <input type="text" name="firstname" ></label>
        <label>Email: <input type="email" name="email" required></label>
        <label>Password: <input type="password" name="password"></label>
        <label>Confirm Password: <input type="password" name="confirm_password"></label>
        <button type="submit">Save Changes</button>

    </form>
</body>

</html> 