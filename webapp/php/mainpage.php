<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('../login.php')</script>";
}

include_once("../dbconnect.php");
if (isset($_GET['button'])){
    $op = $_GET['button'];
    $option = $_GET['option'];
    $search = $_GET['search'];
    if ($op == 'search') {
        if ($option == "name") {
            $sqlproducts = "SELECT * FROM tbl_products WHERE name LIKE '%$search%'";
        }
        if ($option == "ic") {
            $sqlproducts = "SELECT * FROM tbl_products WHERE id LIKE '%$search%'";
        }
        if ($option == "country") {
            $sqlproducts = "SELECT * FROM tbl_products WHERE country LIKE '%$search%'";
        }
    }
} else {
    $sqlproducts = "SELECT * FROM tbl_products ORDER BY regdate DESC";
}

$stmt = $conn->prepare($sqlproducts);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
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
    <title>Mainpage</title>
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
        <a href="newproduct.php" class="w3-bar-item w3-button w3-left">New Product</a>
    </div>

    <div class="w3-card w3-container w3-padding w3-margin w3-round w3-pale-green">
        <h4>Product Search</h4>
        <form action="mainpage.php">
            <div class="w3-row">
                <div class="w3-half w3-container">
                    <p><input class="w3-input w3-block w3-round w3-border" type="search" id="idsearch" name="search" placeholder="Enter search term" /></p>
                </div>
                <div class="w3-half w3-container">
                    <p><select class="w3-input w3-block w3-round w3-border" name="option" id="srcid">
                            <option value="name">By Name</option>
                            <option value="ic">By Code</option>
                            <option value="country">Country</option>
                        </select>
                    <p>
                </div>
            </div>
            <div class="w3-container">
                <p><button class="w3-button w3-green w3-round w3-right" type="submit" name="button" value="search">search</button></p>
            </div>

        </form>
    </div>

    <div class="w3-container w3-pale-green">
    <div class="w3-grid-template">
        <?php
        foreach ($rows as $products) {
            $id = $products['id'];
            $name = $products['name'];
            $price = $products['price'];
            $packaging = $products['packaging'];
            $country = $products['country'];
            echo "<div class='w3-center w3-padding'>";
            echo "<div class='w3-card-4 w3-green'>";
            echo "<header class='w3-container w3-green'";
            echo "<h5>$name</h5>";
            echo "</header>";
            echo "<img class='w3-image' src=../res/images/$id.png" .
            " onerror=this.onerror=null;this.src='../res/images/profile.png'"
            . "style='width:100%;height:250px'>";
            echo "<div class='w3-container w3-left-align'><hr>";
            echo "<p><i class='fa fa-id-card' style='font-size:16px'></i> 
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp$id<br>
            <i class='fa fa-money' style='font-size:16px'>&nbsp(/kg)
            </i>&nbsp&nbsp$price<br>
            <i class='fa fa-shopping-bag' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp$packaging<br>
            <i class='fa fa-flag' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp$country<br></p><hr>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
         }
        ?>
    </div>
    </div>

    <footer class="w3-footer w3-center w3-green">
        <p>Copyright: Durian Sungai Karas</p>
    </footer>


</body>
</html>