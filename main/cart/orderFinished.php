<?php

    session_start();
    $connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

    $name = $_POST['orderName'];
    $surname = $_POST['orderSurname'];
    $telephoneNumber = $_POST['orderTelephone'];
    $adress = $_POST['orderAdress'];
    $postCode = $_POST['orderPostcode'];
    $city = $_POST['orderCity'];
    $shipCost = $_POST['shipCostPost'];
    $finalPrice = $_POST['finalPricePost'];
    $paymentType = $_POST['paymentTypePost'];
    $userID = $_SESSION["user"]['user_id'];
    $orderedProductsArray = $_POST['orderedProducts'];
    $date = date('Y-m-d');

    if($shipCost != 9.99 && $shipCost != 0.00) $shippingAdressArray = ['name' => $name, 'surname' => $surname, 'telephone' => $telephoneNumber, 'sreet' => $adress, 'postcode' => $postCode, 'city' => $city];
    else $shippingAdressArray = ['paczkomatCode' => $_POST['orderPaczkomatCodePost']];
    $serializedShipping_array = serialize($shippingAdressArray);

    $result = $connect->query("INSERT INTO orders(user_id, order_value, ship, payment_type, shipping_adress, ordered_products, order_date, status) VALUES('$userID','$finalPrice', '$shipCost', '$paymentType', '$serializedShipping_array', '$orderedProductsArray', '$date', 'Nowe')");
    
    $orderProductsArray = unserialize($orderedProductsArray);
    foreach ($orderProductsArray as &$cartProduct) {
        $cartProductToRemove = $cartProduct['product_id'];
        $orderedProductCount = $cartProduct['product_quantity'];
        $result = $connect->query("SELECT * FROM product WHERE product_id='$cartProductToRemove'");
        if($row = mysqli_fetch_assoc($result)) {
            $newProduct_magazinePieces = $row['product_magazinePieces']-$orderedProductCount;
            $newProduct_boughtCount = $row['product_boughtCount']+$orderedProductCount;
            $result = $connect->query("UPDATE product SET product_magazinePieces='$newProduct_magazinePieces', product_boughtCount='$newProduct_boughtCount' WHERE product_id='$cartProductToRemove' LIMIT 1");
        }
        $result = $connect->query("DELETE FROM cartproduct WHERE user_id='$userID' AND product_id='$cartProductToRemove'");
    }

    header("Location: orderConfirmedPage.php");

?>