<?php
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
    </head>
    <body>
        <div>
            <form action="Login.php" method="POST">
                <p>
                    <label>Username: </label>
                    <input type="text" id="username" name="username" required/>
                </p>
                <p>
                    <label>Password:</label>
                    <input type="text" id="password" name="password" required/>
                </p>
                <p>
                    <input type="submit" name="submitbtn" id="login" value="Login" />
                    <input id="inp" type="button" value="Home Page" onclick="location.href='Registration.php';" />
                </p>
            </form>

        </div>
    </body>
</html>
