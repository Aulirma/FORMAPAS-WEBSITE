<?php 
session_start();
$connectTo = mysqli_connect('localhost', 'root', '', 'formapas');

if(isset($_POST['logout'])){
    session_destroy();
    header('location: login.php');
}

if(isset($_POST['hapus'])){
    echo "
    <form action='' method='POST'>
        <p>Are you sure you want to delete your account?</p>
        <button type='submit' name='y'>Yes</button>
        <button type='submit' name='n'>No</button>
    </form>";
    exit;
}

    if(isset($_POST['y'])){
        $queryDelete = "DELETE FROM `users` WHERE `username` = '$_SESSION[username]'";
        mysqli_query($connectTo, $queryDelete);
        session_destroy();
        header('location: login.php');
        exit;
    }

    if(isset($_POST['n'])){
        header('location: dashboard.php');
        exit;
    }

if(isset($_POST['ganti'])){
    $username = $_SESSION['username'];
    $hashPass = $_SESSION['hashPass'];

    if(isset($_POST['changenm'])){
        $usrnm1 = $_POST['usrnm1'];
        $usrnm2 = $_POST['usrnm2'];
        $querySearch = "SELECT * FROM `users` WHERE `username` = '$username'";
        $found = mysqli_query($connectTo, $querySearch);

        if($found -> num_rows > 0){
            $querySearchAlt = "SELECT * FROM `users` WHERE `username` = '$usrnm1'";
            $foundAlt = mysqli_query($connectTo, $querySearchAlt);

            if($foundAlt -> num_rows > 0){
                echo "The username $usrnm1 already exist. Please try again.";
            }else if($usrnm1 != $usrnm2){
                echo "New username do not match. Please try again";
            }else if($usrnm1 == $usrnm2){
                $queryChangeNm = "UPDATE `users` SET `username` = '$usrnm1' WHERE `username` = '$username'";
                mysqli_query($connectTo, $queryChangeNm);
                $_SESSION['username'] = $usrnm1;
                echo "Username successfully changed to $usrnm1.";
            }
        }
    }

    if(isset($_POST["changepw"])){
        $pw1 = $_POST["pw1"];
        $pw2 = $_POST["pw2"];
        $hashpw1 = hash('gost', $pw1);
        $querySearch = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$hashPass'";
        $found = mysqli_query($connectTo, $querySearch);

        if($found -> num_rows > 0){
            if($hashpw1 == $hashPass){
                echo "New Password Cannot Be The Same As The Old Password. Please Try Again.";
            }else if($pw1 != $pw2){
                echo "New Passwords Do Not Match. Please Try Again.";
            }else if($pw1 == $pw2){
                $queryChangePw = "UPDATE `users` SET `password` = '$hashpw1' WHERE `username` = '$username'";
                mysqli_query($connectTo, $queryChangePw);
                $_SESSION['hashPass'] = $hashpw1;
                echo "Password Successfully Updated!";
            }
        }
    }

    if(isset($_POST["back"])){
        header ('location: dashboard.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>