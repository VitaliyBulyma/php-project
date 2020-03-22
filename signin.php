<?php

$warning = "none;";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    require 'connection.php';
    $dbcon = Database::connectDB();
    
    $userObj = Database::checkUserCreds($email, $password);

    if ($userObj) {
        if($userObj->user_isAdmin)
            header('Location: admin_dashboard.php?id=' . $userObj->user_id);
        else
            header('Location: user_dashboard.php?id=' . $userObj->user_id);
            
    } else {
        $warning = "block;";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SurveyBobby</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/darkly/bootstrap.min.css" rel="stylesheet" integrity="sha384-rCA2D+D9QXuP2TomtQwd+uP50EHjpafN+wruul0sXZzX/Da7Txn4tB9aLMZV4DZm" crossorigin="anonymous">

</head>

<body>
    <header class="header text-center">
        <p>Header content</p>
    </header>

    <main id="signinSection">
        <!-- LOGIN SECTION BY HILMI -->
        <form id="signinForm" method="POST">
            <fieldset>
                <legend>Sign in to your account</legend>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>

                <button name="login" type="submit" class="btn btn-primary">Sign In</button>
            </fieldset>
        </form>

        <a href="signup.html">Don't have an account yet?</a>

        <div id="wrongUserCred" class="alert alert-dismissible alert-danger" <?= 'style="display: ' . $warning . '"' ?>>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Uh oh!</strong> Invalid username/password!
        </div>
    </main>

    <footer class="footer text-center">
        <p>Footer content</p>
    </footer>


    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>