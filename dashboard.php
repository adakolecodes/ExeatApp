<?php
//TO MAKE USE OF SESSIONS WE HAVE TO FIRST START IT WITH THIS METHOD
session_start();

//CHECK IF STUDENT IS LOGGED IN (if student regnumber is stored in the session), IF STUDENT IS NOT LOGGED IN THEN SEND THEM BACK TO LOGIN PAGE
//THIS DASHBOARD PAGE CANNOT BE ACCESSED WHEN YOU'RE NOT LOGGED IN
if(!isset($_SESSION['regnumber'])){
    header("location: login.php");
}

//LINK DATABASE FILE TO THIS PAGE
include "database-config.php";

$message = "";


if(isset($_POST['submit'])){
    
    $regnumber = filter_input(INPUT_POST, 'regnumber', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $request = filter_input(INPUT_POST, 'request', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $exeatDate = filter_input(INPUT_POST, 'exeatDate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $returnDate = filter_input(INPUT_POST, 'returnDate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    $sql = "INSERT INTO permissions (regnumber, firstname, surname, request, exeatDate, returnDate, classTeacher, houseManager, principal, requestStatus) VALUES ('$regnumber', '$firstname', '$surname', '$request', '$exeatDate', '$returnDate', 'PENDING', 'PENDING', 'PENDING', 'PENDING')";
    
    //If sql query is successful then show a success message else display error message
    if(mysqli_query($conn, $sql)){
        $message = "Permission request submitted successfully";
    }else{
        $message = "An error occured!";
    }
}

//QUERY TO GET PERMISSION REQUESTS FROM DATABASE
$sql = "SELECT * FROM permissions WHERE regnumber = '".$_SESSION['regnumber']."' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="images/logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div>
        <?php include "menu.php"; ?>
    </div>
    <div class="container mt-5 mb-5">
        <h1>Welcome</h1>
        <h4><?php echo $_SESSION['firstname'], " ", $_SESSION['surname']; ?></h4>
        <p><?php echo $_SESSION['regnumber'] ?></p>
        <a href="logout.php" class="btn btn-primary">Logout</a>
        <hr>
        <h4>Request for an exeat</h4>
        <p style="color:green;"><?php echo $message; ?></p>
        <form action="dashboard.php" method="post">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="regnumber" class="form-control mt-3" value="<?php echo $_SESSION['regnumber'] ?>" required readonly>
                </div>
                <div class="col-md-4">
                    <input type="text" name="firstname" class="form-control mt-3" value="<?php echo $_SESSION['firstname'] ?>" required readonly>
                </div>
                <div class="col-md-4">
                    <input type="text" name="surname" class="form-control mt-3" value="<?php echo $_SESSION['surname'] ?>" required readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <textarea name="request" class="form-control" rows="5" placeholder="What request are you seeking permission for?" required></textarea>
                </div>
                <div class="col-md-6">
                    <label class="mt-3">Choose date of exeat</label>
                    <input type="date" name="exeatDate" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="mt-3">Choose date of return</label>
                    <input type="date" name="returnDate" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" name="submit" class="btn btn-primary mt-3">Submit Request</button>
                </div>
            </div>
        </form>
        <hr>
        <h4 class="mt-5">My Permissions</h4>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Request</th>
                    <th>Exeat Date</th>
                    <th>Return Date</th>
                    <th>Class Teacher</th>
                    <th>House Manager</th>
                    <th>Principal</th>
                    <th>Request status</th>
                    <th>Date created</th>
                </tr>
            </thead>
            <tbody>
                <?php while($permissions = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $permissions['request']; ?></td>
                        <td><?php echo $permissions['exeatDate']; ?></td>
                        <td><?php echo $permissions['returnDate']; ?></td>
                        <td><?php echo $permissions['classTeacher']; ?></td>
                        <td><?php echo $permissions['houseManager']; ?></td>
                        <td><?php echo $permissions['principal']; ?></td>
                        <td><?php echo $permissions['requestStatus']; ?></td>
                        <td><?php echo $permissions['created']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>