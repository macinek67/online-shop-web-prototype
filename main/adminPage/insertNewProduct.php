<?php

$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if(isset($_POST['newProductSubmited'])) {
    $imgArr = explode(",", $_POST['imgsArray']);
    $productImages = [];
    foreach($imgArr as &$img) {
        if($img != null) {
            $currentImg = 'productImage'. $img;
            if(basename($_FILES[$currentImg]['name']) != "") {
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
    }
    $productDescription = $_POST['productDescriptionText'];
    $serializedProductProperties = serialize($productProperties);
    $serializedProductImages = serialize($productImages);
    $result = $connect->query("INSERT INTO product(product_magazinePieces, product_title, product_price, product_regularPrice, 
    product_properties, product_description, category_id, product_img, isSuspended) VALUES('$productMagazineStock','$productTitle', 
    '$productDiscountPrice', '$productRegularPrice', '$serializedProductProperties', '$productDescription', '$productCategory', '$serializedProductImages', 'no')");
}

?>