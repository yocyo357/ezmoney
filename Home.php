<?php
session_start();

include "DBconfig.php";

function alert($msg)
{
    echo '<script language="javascript">alert("' . $msg . '");</script>';
}



//create connection
$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);

$username = "";
$userid = "";


if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
}

$in = 'Login';
$out = 'Signup';
$loanbtn = 'Apply now';
if ($username != "") {
    $out = 'Logout';
    $in = $username;
    $loanbtn = 'submit';
}

if (isset($_POST['submitbtn'])) {

    if ($username == "") {
        header('Location: Login.php');
    } else {
        $amount = ($_POST['amount']);
        $length = ($_POST['length']);
        $reason = ($_POST['reason']);


        $sql = "INSERT INTO loan (user_id, amount, length, reason, status)
        VALUES ('" . $userid . "','" . $amount . "', '" . $length . "','" . $reason . "', '" . "pending" . "')";

        if ($conn->query($sql) === true) {


            alert("Loan Successfull");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}

if (isset($_POST['submitbtn2'])) {
    $payment = ($_POST['payment']);


    $sql = "UPDATE loan SET status='paid', payment_method='" . $payment . "' where user_id='" . $userid . "' ";


    if ($conn->query($sql) === TRUE) {
        alert('Payment Successful');
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>
        Home Page
    </title>

    <link rel="stylesheet" href="css/homestyle.css" />
</head>

<body>
    <br />
    <div class="topnav">
        <img src="images/ezmoneylogo.png" class="logo">
        <div class="topnav-right">
            <a onclick="openPage('Home', this )">Home</a>
            <a onclick="openPage('About', this)">About</a>
            <a onclick="openPage('Contact', this)">Contact</a>
            <a onclick="openPage('Login', this)"><?php echo $in; ?></a>
            <a onclick="openPage('Signup', this)"><?php echo $out; ?></a>
        </div>
    </div>

    <?php
    $conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);
    $sql = "SELECT * FROM loan where status='pending'";
    $result = $conn->query($sql);
    $style = "";
    $style1 = "";
    $lamount = "";
    $llength = "";
    $reason = "";
    if ($result->num_rows > 0 && $username != "") {
        $style = "style='display:none;'";

        while ($row = $result->fetch_assoc()) {
            $lamount = $row['amount'];
            $llength = $row['length'];
            $lreason = $row['reason'];
        }
    } else {
        $style1 = "style='display:none;'";
    }
    $conn->close();
    ?>

    <div id="Home" class="tabcontent">
        <div <?php echo $style; ?>>

            <div class="maincontainer">
                <!-- Loan form -->
                <form action="Home.php" method="POST">
                    <div class="row">
                        <div class="column">
                            <!-- Loan Amount -->
                            <div class="slidecontainer">
                                <label><b> LOAN AMOUNT</b></label>
                                <br />
                                <label class='pricelabel'><b><sup class="pricesuperscript">Php</sup><span id="demo"></b></label>
                                <br />
                                <input type="range" name="amount" min="1" max="2000" value="1000" class="slider" id="myRange">
                            </div>
                            <script>
                                var slider = document.getElementById("myRange");
                                var output = document.getElementById("demo");
                                output.innerHTML = slider.value;

                                slider.oninput = function() {
                                    output.innerHTML = this.value;
                                }
                            </script>

                            <!-- Loan Length -->
                            <br>
                            <div>
                                <label><b> LOAN LENGHT</b></label><br><br>
                                <input type="radio" name="length" value="1 month" checked> <label> 1 month</label>
                                <input type="radio" name="length" value="2 months"> <label> 2 months</label>
                                <input type="radio" name="length" value="3 months"> <label> 3 months</label>
                            </div>

                            <hr>
                            <!-- Loan Reason -->
                            <div>
                                <br>
                                <label><b> REASON</b></label><br><br>
                                <select class="custom-select" name="reason">
                                    <option value="Tuition">Tuition</option>
                                    <option value="Emergency">Emergency</option>
                                    <option value="Vacation">Vacation</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="column1">
                            <div class="sec_column">
                                <br>
                                <label><b> PAYMENT DETAILS</b></label><br><br>
                                <label> Amount Borrowed &nbsp; &nbsp; Php 400<span id="demo"></b></label></label><br>
                                <hr><br>
                                <label> Interest &nbsp; &nbsp; 12%<span id="demo"></b></label></label><br>
                                <hr><br>
                                <label> Total Payment &nbsp; &nbsp; Php 400<span id="demo"></b></label></label><br>
                                <hr class="greenhr"><br>

                                <button type="submit" name="submitbtn"> <?php echo $loanbtn; ?></button>

                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div <?php echo $style1; ?>>

            <div class="maincontainer">
                <!-- Payment form -->
                <form class="form2" action="Home.php" method="POST">

                    <!-- Amount borrowed -->
                    <div class="slidecontainer">
                        <label> Amount Borrowed &nbsp; &nbsp; <?php echo $lamount; ?></label></label><br>

                        <!-- <p>Amount Borrowed: <?php echo $lamount; ?> </p> -->
                    </div>

                    <!-- Loan Length -->
                    <div>
                        <p>Loan Length: <?php echo $llength; ?></p>
                    </div>
                    <!-- Loan Reason -->
                    <div>
                        <p>Reason: <?php echo $lreason; ?></p>
                    </div>

                    <div>
                        <p>Payment method: </p>
                        <select name="payment">
                            <option value="ATM">ATM</option>
                            <option value="Palawan">Palawan</option>
                            <option value="Cebuana">Cebuana</option>
                        </select>
                    </div>
                    <br>
                    <button type="submit" name="submitbtn2">Pay Loan</button>
                </form>

                <div class="maincontainer">

                </div>

            </div>
            <div id="Contact" class="tabcontent">
                <?php include 'Contact.php'; ?>
            </div>

            <div id="About" class="tabcontent">
                <?php include 'About.php'; ?>
            </div>

            <div id="Login" class="tabcontent">

            </div>

            <div id="Signup" class="tabcontent">

            </div>

            <script>
                function openPage(pageName, elmnt) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    var username = "<?php print($username); ?>";


                    if (pageName == 'Login' && username == "") {
                        location.replace("Login.php")
                    } else if (pageName == 'Signup') {
                        if (username == "") {
                            location.replace("Registration.php")

                        } else {
                            location.replace("unset.php")
                        }
                    }


                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablink");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].style.backgroundColor = "";
                    }
                    document.getElementById(pageName).style.display = "block";
                    elmnt.style.backgroundColor = 'gray';
                }

                // Get the element with id="defaultOpen" and click on it
                document.getElementById("defaultOpen").click();
            </script>

</body>

</html>