<?php

require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {


    if(empty(trim($_POST["username"]))) {
        $username_err = "Vul een gebruikersnaam in.";
    } else {

        $sql = "SELECT id FROM users WHERE username = ?";

    }

    if(empty(trim($_POST["password"]))) {
        $password_err = "Vul aub een wachtwoord in.";
    } elseif(strlen(trim($_POST["password"])) < 6) {
        $password_err = "Jouw wachtwoord heeft minimaal 6 letters nodig.";
    } else{
        $password = trim($_POST["password"]);
    }


    if(empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Bevestig aub jouw wachtwoord";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Je hebt niet dezelfde wachtwoord gebruikt.";
        }
    }


    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)) {


        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

    }}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Inloggen</h2>
    <p>Vul jouw gegevens in:</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Inlognaam</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Wachtwoord</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Bevestig wachtwoord</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
        <p>Heb je al een account? <a href="login.php">Log in!</a>.</p>
    </form>
</div>
</body>
</html>