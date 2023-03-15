<?php
//TO MAKE USE OF SESSIONS WE HAVE TO FIRST START IT WITH THIS METHOD
session_start();

//LINK DATABASE FILE TO THIS PAGE
include "database-config.php";

$error = "";

if(isset($_POST['login'])){
    // $regnumber = $_POST['regnumber'];
    // $password = $_POST['password'];

    $regnumber = filter_input(INPUT_POST, 'regnumber', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    $sql = "SELECT * FROM students WHERE regnumber = '$regnumber' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $user = $result->fetch_assoc();

    if($user){
        $_SESSION['regnumber'] = $user['regnumber'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['surname'] = $user['surname'];
        header("location: dashboard.php");
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
            <h1 class="mb-3">Login</h1>
            <p class="text-danger"><?php echo $error; ?></p>
            <form action="<?php echo htmlspecialchars("login.php"); ?>" method="post">
                <div class="col-md-6">
                    <input type="text" name="regnumber" class="form-control mb-3" placeholder="Registration Number" required>
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