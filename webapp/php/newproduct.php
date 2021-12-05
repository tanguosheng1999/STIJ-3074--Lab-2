<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('../login.php')</script>";
}
if (isset($_POST["submit"])) {
    include_once("../dbconnect.php");
    $name = $_POST["name"];
    $idno = $_POST["idno"];
    $price = $_POST["price"];
    $packaging = $_POST["packaging"];
    $country = $_POST["country"];
    $sqlregister = "INSERT INTO `tbl_products`(`id`,`name`, `price`, `packaging`, `country`) VALUES('$idno','$name', '$price', '$packaging', '$country')";
    try {
        $conn->exec($sqlregister);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            uploadImage($idno);
        }
        echo "<script>alert('Registration successful')</script>";
        echo "<script>window.location.replace('mainpage.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Registration failed')</script>";
        echo "<script>window.location.replace('newproduct.php')</script>";
    }
}

function uploadImage($id)
{
    $target_dir = "../res/images/";
    $target_file = $target_dir . $id . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script src="../javascript/script.js"></script>
    <title>Our Product</title>
</head>

<body>
<div id="HOME" class="w3-bar w3-green">
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

    <div class="w3-bar w3-green">
        <a href="#contract" class="w3-bar-item w3-button w3-right">Logout</a>
        <a href="newproduct.php" class="w3-bar-item w3-button w3-left">Home</a>
    </div>

    <div class="w3-container w3-padding-64 w3-pale-green">
    <div class="w3-container w3-padding-64 form-container-reg w3-pale-green">
        <div class="w3-card">
            <div class="w3-container w3-green">
                <p>New Product Registration<p>
            </div>

            <form class="w3-container w3-padding" name="registerForm" action="newproduct.php" method="post" onsubmit="return confirmDialog()" enctype="multipart/form-data">
                <div class="w3-container w3-border w3-center w3-padding">
                    <img class="w3-image w3-round w3-margin" src="../res/images/profile.png" style="width:100%; max-width:600px"><br>
                    <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
                </div>

                <p>
                    <label>Product Name</label>
                    <input class="w3-input w3-border w3-round" name="name" id="idname" type="text" required>
                </p>

                <p>
                    <label>ID/CODE</label>
                    <input class="w3-input w3-border w3-round" name="idno" id="idid" type="text" required>
                </p>

                <p>
                    <label>Price(per kg)</label>
                    <input class="w3-input w3-border w3-round" name="price" id="priceid" type="text" required>
                </p>

                <p>
                    <label>Packaging</label>
                    <select class="w3-input w3-border w3-round" name="packaging" id="packagingid">
                        <option value="Box">Box</option>
                        <option value="Vacuum">Vacuum</option>
                        <option value="Unpack">Unpack</option>
                    </select>
                </p>
                
                <p>
                    <label>Country</label>
                    <select class="w3-input w3-border w3-round" name="country" id="countryid">
                        <option value="Malaysia">Malaysia</option>
                        <option value="Thailand">Thailand</option>
                        <option value="China">China</option>
                        <option value="Australia">Australia</option>
                        <option value="Others">Others</option>
                    </select>
                </p>

                <div class="row">
                    <input class="w3-input w3-border w3-block w3-green w3-round" type="submit" name="submit" value="Submit">
                </div>

            </form>
        </div>
    </div>
    </div>

    <footer class="w3-footer w3-center w3-green">
        <p>Copyright: Durian Sungai Karas</p>
    </footer>


</body>
</html>