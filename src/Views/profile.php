<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <h1>Profile</h1>
    <form action="/profile" method="POST">
        <label>Name: <input type="text" name="name" value="<?php echo $_SESSION['name']; ?>" required></label>
        <label>Firstname: <input type="text" name="firstname" value="<?php echo $_SESSION['firstname']; ?>"></label>
<label>Email: <input type="email" name="email" value="<php echo $_SESSION['email']; ?" required></label>
<label>Password: <input type="password" name="password"></label>
<label>Confirm Password: <input type="password" name="confirm_password"></label>
<button type="submit">Save Changes</button>

</form> </body> </html> ``` `controllers/ProfileController.php`: ```php <?php class ProfileController { public function index() { require_once __DIR__ . "/../views/profile.php"; }
public function update()
{
    $user = new User();
    $user->update($_SESSION['user_id'], $_POST['name'], $_POST['firstname'], $_POST['email'], $_POST['password']);
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['email'] = $_POST['email'];
    header("Location: /profile");
}
}
