<?php
//TO MAKE USE OF SESSIONS WE HAVE TO FIRST START IT WITH THIS METHOD
session_start();

//CHECK IF ADMIN IS LOGGED IN (if admin username is stored in the session), IF ADMIN IS NOT LOGGED IN THEN SEND THEM BACK TO ADMIN LOGIN PAGE
//THIS DASHBOARD PAGE CANNOT BE ACCESSED WHEN YOU'RE NOT LOGGED IN
if(!isset($_SESSION['username'])){
    header("location: admin-login.php");
}

//LINK DATABASE FILE TO THIS PAGE
include "database-config.php";

$message = "";

//GIVE APPROVAL
if(isset($_GET['approve'])){
    
    $id = $_GET['approve'];

    if($_SESSION['username'] == "classteacher"){
        $sql = "UPDATE permissions SET classTeacher = 'APPROVED' WHERE id = $id";
    }elseif($_SESSION['username'] == "housemanager"){
        $sql = "UPDATE permissions SET houseManager = 'APPROVED' WHERE id = $id";
    }elseif($_SESSION['username'] == "principal"){
        $sql = "UPDATE permissions SET principal = 'APPROVED', requestStatus = 'APPROVED' WHERE id = $id";
    }
    
    //If sql query is successful then show a success message else display error message
    if(mysqli_query($conn, $sql)){
        $message = "Approval given successfully";
    }else{
        $message = "An error occured!";
    }
}

//GIVE DISAPPROVAL
if(isset($_GET['disapprove'])){
    
    $id = $_GET['disapprove'];

    if($_SESSION['username'] == "classteacher"){
        $sql = "UPDATE permissions SET classTeacher = 'DISAPPROVED' WHERE id = $id";
    }elseif($_SESSION['username'] == "housemanager"){
        $sql = "UPDATE permissions SET houseManager = 'DISAPPROVED' WHERE id = $id";
    }elseif($_SESSION['username'] == "principal"){
        $sql = "UPDATE permissions SET principal = 'DISAPPROVED', requestStatus = 'DISAPPROVED' WHERE id = $id";
    }
    
    //If sql query is successful then show a success message else display error message
    if(mysqli_query($conn, $sql)){
        $message = "This student request has been disapproved";
    }else{
        $message = "An error occured!";
    }
}

//QUERY TO GET PERMISSION REQUESTS FROM DATABASE
$sql = "SELECT * FROM permissions ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="images/logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div>
        <?php include "menu.php"; ?>
    </div>
    <div class="container mt-5 mb-5">
        <h1>Welcome</h1>
        <p><?php echo $_SESSION['username'] ?></p>
        <a href="admin-logout.php" class="btn btn-primary">Logout</a>
        <p style="color:green;"><?php echo $message; ?></p>
        <hr>
        <h4 class="mt-5">Permissions</h4>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Reg No.</th>
                    <th>Name</th>
                    <th>Request</th>
                    <th>Exeat Date</th>
                    <th>Return Date</th>
                    <th>Class Teacher</th>
                    <th>House Manager</th>
                    <th>Principal</th>
                    <th>Request status</th>
                    <th>Date created</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while($permissions = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $permissions['regnumber']; ?></td>
                        <td><?php echo $permissions['firstname']; ?> <?php echo $permissions['surname']; ?></td>
                        <td><?php echo $permissions['request']; ?></td>
                        <td><?php echo $permissions['exeatDate']; ?></td>
                        <td><?php echo $permissions['returnDate']; ?></td>
                        <td><?php echo $permissions['classTeacher']; ?></td>
                        <td><?php echo $permissions['houseManager']; ?></td>
                        <td><?php echo $permissions['principal']; ?></td>
                        <td><?php echo $permissions['requestStatus']; ?></td>
                        <td><?php echo $permissions['created']; ?></td>
                        <td><a href="admin-dashboard.php?approve=<?php echo $permissions['id']; ?>" class="btn btn-primary btn-sm">Approve</a></td>
                        <td><a href="admin-dashboard.php?disapprove=<?php echo $permissions['id']; ?>" class="btn btn-danger btn-sm">Disapprove</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>