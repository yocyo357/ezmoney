<!DOCTYPE html>
<html>

<head>
    <title>
        Contact Page
    </title>
    <link rel="stylesheet" href="css/contactstyle.css" />
</head>

<body>

    <div class="main-container">
        <div class="contact-container">

            <h2>Contact Us</h2>
            <div class="container">
                <form action="/action_page.php">
                    <label class="contactlabel" for="fname">First Name</label>
                    <input type="text" id="fname" name="firstname" placeholder="Your name..">

                    <label class="contactlabel"  for="lname">Last Name</label>
                    <input type="text" id="lname" name="lastname" placeholder="Your last name..">

                    <label class="contactlabel" for="country">Province</label>
                    <select id="country" name="country">
                        <option value="australia">Davao City</option>
                        <option value="canada">Davao del Sur</option>
                        <option value="usa">Davao Oriental</option>
                        <option value="usa">Davao Occidental</option>
                    </select>

                    <label class="contactlabel"  for="subject">Subject</label>
                    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>

</body>

</html>