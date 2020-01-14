<?php
include "DBconfig.php";

function alert($msg, $url)
{
    echo '<script language="javascript">alert("' . $msg . '");</script>';
    echo "<script>document.location = '$url'</script>";
}

//create connection
$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);
$userexist = '';

if (isset($_POST['submitbtn'])) {
    $username = ($_POST['username']);
    $password = ($_POST['password']);
    $l_name = ($_POST['l_name']);
    $f_name = ($_POST['f_name']);
    $m_initial = ($_POST['m_initial']);
    $b_day = ($_POST['b_day']);
    $school = ($_POST['school']);
    $address = ($_POST['address']);
    $p_id = ($_POST['p_id']);
    $c_number = ($_POST['c_number']);
    $email = ($_POST['email']);

    //query to check if username already exists
    $sql = "SELECT username FROM users where username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //call alert function to display the message and redirect to Registration
        alert('Username already exists', 'Registration.php');

    } else {
        //Insert the values to database
        $sql = "INSERT INTO users (username, password, l_name, f_name, m_initial, b_day, school, address, p_id, c_number, email)
        VALUES ('" . $username . "', '" . $password . "','" . $l_name . "', '" . $f_name . "','" . $m_initial . "', '" . $b_day . "','" . $school . "', '" . $address . "', '" . $p_id . "', '" . $c_number . "', '" . $email . "')";

        if ($conn->query($sql) === true) {

            //call alert function to display the message and redirect to login page
            alert("New record created successfully", "Login.php");

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}

?>


<!DOCTYPE html>
<html>

    <head>
        <title>
            Registration Page
        </title>
    </head>
    <body>
        <div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <p>
                    <label>Username: </label>
                    <input type="text" id="username" name="username" required pattern=".{6,}" title="6 characters minimum"/>
                </p>

                <p>
                    <label>Password:</label>
                    <input type="text" id="password" name="password" required pattern=".{6,}" title="6 characters minimum"/>
                </p>

                <p>
                    <label>Last Name:</label>
                    <input type="text" id="l_name" name="l_name" required/>
                </p>

                <p>
                    <label>First name: </label>
                    <input type="text" id="f_name" name="f_name" required/>
                </p>

                <p>
                    <label>Middle Initial: </label>
                    <input type="text" id="m_initial" name="m_initial" required/>
                </p>

                <p>
                    <label>Birthday: </label>
                    <input type="date" id="b_day" name="b_day" required/>
                </p>

                <p>
                    <label>School: </label>
                    <input type="text" id="school" name="school" required/>
                </p>

                <p>
                    <label>Address: </label>
                    <input type="text" id="address" name="address" required/>
                </p>

                <p>
                    <label>Postal ID: </label>
                    <input  type="number" id="p_id" name="p_id" required/>
                </p>

                <p>
                    <label>Contact number: </label>
                    <input type="number" id="c_number" name="c_number" required/>
                </p>

                <p>
                    <label>Email Address: </label>
                    <input type="text" id="email" name="email" required/>
                </p>

                <p>
                    <input type="submit" name="submitbtn" value="Submit" />

                </p>
            </form>
        </div>
    </body>
</html>
