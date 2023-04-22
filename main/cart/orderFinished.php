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

    if($shipCost != 9.99 && $shipCost != 0.00) $shippingAdressArray = ['name' => $name, 'surname' => $surname, 'telephone' => $telephoneNumber, 'sreet' => $adress, 'postcode' => $postCode, 'city' => $city];
    else $shippingAdressArray = ['paczkomatCode' => $_POST['orderPaczkomatCodePost']];
    $serializedShipping_array = serialize($shippingAdressArray);

    $result = $connect->query("INSERT INTO orders(user_id, order_value, ship, payment_type, shipping_adress, ordered_products) VALUES('$userID','$finalPrice', '$shipCost', '$paymentType', '$serializedShipping_array', '$orderedProductsArray')");
    header("Location: orderConfirmedPage.php");
    //print_r($serializedShipping_array);
    // $serialized_array = unserialize($serialized_array); 
    // print_r($serialized_array);

?>