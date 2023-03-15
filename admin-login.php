<?php
//TO MAKE USE OF SESSIONS WE HAVE TO FIRST START IT WITH THIS METHOD
session_start();

//LINK DATABASE FILE TO THIS PAGE
include "database-config.php";

$error = "";

if(isset($_POST['login'])){
    // $regnumber = $_POST['regnumber'];
    // $password = $_POST['password'];

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    $sql = "SELECT * FROM admins WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $user = $result->fetch_assoc();

    if($user){
        $_SESSION['username'] = $user['username'];
        header("location: admin-dashboard.php");
    }else{
        $error = "Invalid credentials";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="images/logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div>
        <?php include "menu.php"; ?>
    </div>
    <div class="container mt-5 mb-5">
        <div>
            <h1 class="mb-3">Admin Login</h1>
            <p class="text-danger"><?php echo $error; ?></p>
            <form action="<?php echo htmlspecialchars("admin-login.php"); ?>" method="post">
                <div class="col-md-6">
                    <select name="username" class="form-select mb-3" required>
                        <option selected disabled value="">Select a user</option>
                        <option value="classteacher">classteacher</option>
                        <option value="housemanager">housemanager</option>
                        <option value="principal">principal</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                </div>
                <div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>