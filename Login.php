<?php
session_start();
include "DBconfig.php";

function alert($msg)
{
    echo '<script language="javascript">alert("' . $msg . '");</script>';
}

//create connection
$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);


if (isset($_POST['submitbtn'])) {
    $username = ($_POST['username']);
    $password = ($_POST['password']);


    //Login query
    $sql = "SELECT * FROM users where username='$username' and password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username']= $username;
        $_SESSION['userid'] = $row['ID'];
        
        header('Location: Home.php');
    } else {
        //call alert function to display the message
        alert("Wrong Username or Password");
    }

    $conn->close();
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>
        Login Page
    </title>
    <link rel="stylesheet" href="css/loginstyle.css" />
</head>

<body>
    <div class="maincontainer">
        <!-- <label class="loginlabel">EzMoney</label> -->
        <form action="Login.php" method="POST">
            <div class="container">

                <div class="labelcontainer">
                    <img src="images/ezmoneylogo.png" class="logo">
                    <!-- <label class="loginlabel">EzMoney</label> -->
                </div>
                <br>
                <label for="uname"><b>Username</b></label>
                <input type="text" id="username" name="username" required />

                <label for="psw"><b>Password</b></label>
                <input type="text" id="password" name="password" required />

                <button type="submit" name="submitbtn">Login</button>
                <label>
                    <!-- <input type="checkbox" checked="checked" name="remember"> -->
                    Don't have an account?
                    <a href="Registration.php">Create one</a>
                </label>
                <!-- <input type="submit" name="submitbtn" id="login" value="Login" /> -->
                <!-- <input id="inp" type="button" value="Home Page" onclick="location.href='Registration.php';" /> -->
            </div>
        </form>
    </div>

</body>

</html>