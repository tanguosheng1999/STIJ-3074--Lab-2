<?php
if (isset($_POST["submit"])) {
    include 'dbconnect.php';
    $email = $_POST["email"];
    $pass = sha1($_POST["password"]);
    $stmt = $conn->prepare("SELECT * FROM tbl_admin WHERE email = '$email' AND password = '$pass'");
    $stmt->execute();
    $number_of_rows = $stmt->fetchColumn();
    if ($number_of_rows  > 0) {
        session_start();
        $_SESSION["sessionid"] = session_id();
        echo "<script>alert('Login Success');</script>";
        echo "<script> window.location.replace('php/mainpage.php')</script>";
    } else {
        echo "<script>alert('Login Failed');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="javascript/script.js"></script>
    <title>Login</title>

</head>
<body onload="loadCookies()">
    <div class="w3-header w3-container w3-row w3-green w3-padding-32">
        <div class="w3-display-container w3-third w3-padding-24 w3-hide-small" style="height: 240px;">
            <img src="logo 1.png"  width="200" height="200" class="w3-display-topmiddle" style="font-size: 256px;">
        </div>

        <div class="w3-header w3-container w3-twothird">
            <h1 style="font-size:calc(10px + 2vw); font-family:algerian; font-weight:bold" class=" w3-center w3-hide-small w3-text-black">WELCOME TO<br>DURIAN SUNGAI KARAS</h1>
            <h2 style="font-size:calc(14px + 3vw); font-family:algerian; font-weight:bold" class="w3-center w3-hide-large w3-hide-medium w3-text-black">WELCOME TO<br>DURIAN SUNGAI KARAS</h1>
            <p style="font-size:calc(6px + 1vw); font-family:time new roman; font-weight:bold" class="w3-center w3-text-yellow w3-hide-small">Musang King, Udang Merah, XO, IOI, Nyonya, Kampung</p>
            <p style="font-size:calc(7px + 1vw); font-family:time new roman; font-weight:bold" class="w3-center w3-text-yellow w3-hide-large w3-hide-medium">Musang King, Udang Merah, XO, IOI, Nyonya, Kampung</p>
        </div>
    </div>
    
    <div class="w3-container w3-padding-64 w3-pale-green">
        <div class="w3-container w3-padding-64 w3-pale-green form-container">
        <div class="w3-card-4 w3-round">

            <div class="w3-container w3-green w3-round">
                <h2>Login</h2>
            </div>

            <form name="loginForm" class="w3-container" action="login.php" method="post">
                <p>
                    <label class="w3-text-green"><b>Email</b></label>
                    <input class="w3-input w3-border w3-round" name="email" type="email" id="idemail" required>
                </p>

                <p>
                    <label class="w3-text-green"><b>Password</b></label>
                    <input class="w3-input w3-border w3-round" name="password" type="password" id="idpass" required>
                </p>

                <p>
                    <input class="w3-check" type="checkbox" id="idremember" name="remember" onclick="rememberMe()">
                    <label>Remember Me</label>
                </p>

                <p>
                    <button class="w3-btn w3-round w3-green w3-block" name="submit">Login</button>
                </p>
            </form>
        </div>
        </div>
    </div>

    <footer class="w3-container w3-green w3-center">
        <p class="w3-text-yellow">Copyright: Durian Sungai Karas</p>
    </footer>

    <div id="cookieNotice" class="w3-right w3-block" style="display: none;">
        <div class="w3-green">
            <h4>Cookie Consent</h4>
            <p>This website uses cookies or similar technologies, to enhance your
                browsing experience and provide personalized recommendations.
                By continuing to use our website, you agree to our
                <a style="color:#115cfa;" href="/privacy-policy">Privacy Policy</a>
            </p>
            <div class="w3-button">
                <button onclick="acceptCookieConsent();">Accept</button>
            </div>
        </div>
        <script>
            let cookie_consent = getCookie("user_cookie_consent");
            if (cookie_consent != "") {
                document.getElementById("cookieNotice").style.display = "none";
            } else {
                document.getElementById("cookieNotice").style.display = "block";
            }
        </script>



</body>
</html>