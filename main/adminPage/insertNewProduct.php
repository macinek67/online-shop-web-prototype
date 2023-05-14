<?php

$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if(isset($_POST['newProductSubmited'])) {

    $imgArr = explode(",", $_POST['imgsArray']);
    $productImages = [];
    if(isset($_POST['productId'])) $productId = $_POST['productId'];

    foreach($imgArr as &$img) {
        if($img != null) {
            $currentImg = 'productImage'. $img;
            if(basename($_FILES[$currentImg]['name']) == "") {
                $result = $connect->query("SELECT product_img FROM product WHERE product_id='$productId' LIMIT 1");
                if($row = mysqli_fetch_assoc($result)) {
                    $unserializedProductImages = unserialize($row['product_img']);
                    array_push($productImages, $unserializedProductImages[$img-1]);
                }
            } else {
                $uploadfile = "../../uploadedProductImages/" . basename($_FILES[$currentImg]['name']);
                move_uploaded_file($_FILES[$currentImg]['tmp_name'], $uploadfile);
                array_push($productImages, basename($_FILES[$currentImg]['name']));
            }
        }
    }


    $propArray = json_decode($_POST['propsArray'], true);
    $productProperties = [];

    foreach($propArray as &$prop) {
        if($prop != null && $prop['propertyType'] != "" && $prop['propertyTypeValue'] != "") {
            array_push($productProperties, [0 => $prop['propertyType'], 1 => $prop['propertyTypeValue']]);
        }
    }


    $productTitle = $_POST['productTitle'];
    $productRegularPrice = $_POST['productRegularPrice'];
    $productDiscountPrice = $_POST['productDiscountPrice'];
    $productMagazineStock = $_POST['productMagazineStock'];


    $productCategory = $_POST['productCategory'];

    if($productCategory != "Aktualna") {
        $result = $connect->query("SELECT * FROM category WHERE name='$productCategory' LIMIT 1");
        if($row = mysqli_fetch_assoc($result)) {
            $productCategory = $row['category_id'];
            array_unshift($productProperties, [0 => "Kategoria", 1 => $productCategory]);
        }
    } else {
        $result = $connect->query("SELECT category_id FROM product WHERE product_id='$productId' LIMIT 1");
        if($row = mysqli_fetch_assoc($result)) $productCategory = $row['category_id'];
        array_unshift($productProperties, [0 => "Kategoria", 1 => $productCategory]);
    }


    $productDescription = $_POST['productDescriptionText'];
    $serializedProductProperties = serialize($productProperties);
    $serializedProductImages = serialize($productImages);


    $usingMethod = $_POST['usingMethod'];

    if($usingMethod == "adding")
        $result = $connect->query("INSERT INTO product(product_magazinePieces, product_title, product_price, product_regularPrice, 
        product_properties, product_description, category_id, product_img, isSuspended) VALUES('$productMagazineStock','$productTitle', 
        '$productDiscountPrice', '$productRegularPrice', '$serializedProductProperties', '$productDescription', '$productCategory', '$serializedProductImages', 'no')");
    else 
        $result = $connect->query("UPDATE product SET product_magazinePieces='$productMagazineStock', product_title='$productTitle', product_price='$productDiscountPrice', 
        product_regularPrice='$productRegularPrice', product_properties='$serializedProductProperties', product_description='$productDescription', category_id='$productCategory',
        product_img='$serializedProductImages' WHERE product_id='$productId'");

    
    header("Location: index.php");

}

?>