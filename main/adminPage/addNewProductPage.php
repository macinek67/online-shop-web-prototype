<?php
    session_start();
    if($_SESSION['loggedIn'] != true || $_SESSION["user"]['isAdmin'] != 1) header("Location: ../index.php");
    require_once('../php/classes.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../MainPageSTYLES.css">
    <link rel="stylesheet" href="addNewProductPageStyles.css">
</head>
<body>
    <div class="headerDiv" style="top: 0;">
        <img src="../../images/gstore.png" class="headerDivLogo" onclick='window.location="../index.php";'>
        <input type="button" id="accountIconID" class="headerDivIcons" onclick="AccountMenuOpen()">
    </div>



    <div class="addNewProductContainer">
        <form class="productSelectedImagesContainer" action="insertNewProduct.php" method="post" enctype="multipart/form-data">
            <div id="imagesContainerId">
            <?php
                $productEditData = ["product_title" => "", "product_regularPrice" => "", "product_price" => "", "product_magazinePieces" => "", "product_properties" => "", "product_description" => ""];
                    if(isset($_POST['productId'])) {
                        $product = $_POST['productId'];
                        $result = $connect->query("SELECT * FROM product WHERE product_id='$product'");
                        if($row = mysqli_fetch_assoc($result)) {
                            $productEditData = $row;
                        }
                        $imgs = unserialize($productEditData['product_img']);
                        $i = 0;
                        foreach($imgs as &$img) {
                            echo "<div class='productGotImageContainer' id='productGotImageContainer$i'>
                                <img src='../../uploadedProductImages/$img' class='productGotImage'>
                                <input type='file' name='productImage$i' onchange='productImageChanged($i)' class='upload-photo' id='upload-photo$i'/>
                                <label class='productImageDeleteLabel' onclick='productImageDelete($i)'>Usuń</label>
                                <label for='upload-photo$i' id='editImageLabel$i' class='productImageEditLabel'>Edytuj</label>
                            </div>";
                            $i++;
                        }
                    } else $i = 0;
                    echo "<div class='productGotImageContainer' id='productGotImageContainer$i'>
                        <img class='productGotImage'>
                        <input type='file' name='productImage$i' onchange='productImageChanged($i)' class='upload-photo' id='upload-photo$i'/>
                        <label class='productImageDeleteLabel' onclick='productImageDelete($i)'>Usuń</label>
                        <label for='upload-photo$i' id='editImageLabel$i' class='productImageEditLabel'>Dodaj</label>
                    </div>";
                ?>
            </div>
            <label class="boldLabel">* Tytuł produktu (np: Dysk samsung 980 PRO)</label><br>
            <input type="text" value='<?php echo $productEditData['product_title']; ?>' name="productTitle" class="productValueInput">
            <label class="boldLabel">* Cena regularna (np: 899,99)</label><br>
            <input type="number" value='<?php echo $productEditData['product_regularPrice']; ?>' name="productRegularPrice" class="productValueInput">
            <label class="boldLabel">Cena promocyjna (np: 799,99)</label><br>
            <input type="number" value='<?php echo $productEditData['product_price']; ?>' name="productRegularPrice" class="productValueInput">
            <label class="boldLabel">* Ilość magazynowa (np: 9)</label><br>
            <input type="number" value='<?php echo $productEditData['product_magazinePieces']; ?>' name="productRegularPrice" class="productValueInput"><br>
            <label class="boldLabel">* Szczegóły (np: Kolor : niebieski)</label><br>
            <div class="productPropertyContainer" id="productPropertyContainerId">
                <?php
                    if(isset($_POST['productId'])) {
                        $properties = unserialize($productEditData['product_properties']);
                        $i = 0;
                        foreach($properties as &$property) {
                            echo "<div id='property$i' style='margin-bottom: 15px;'><input type='text' value='$property[0]' name='propertyType$i' id='propertyType$i' class='propertyType'>
                            <label id='boldColon'> : </label>
                            <input type='text' value='$property[1]' name='propertyTypeValue$i' id='propertyTypeValue$i' class='propertyTypeValue'>
                            <label class='deleteProperyLabel' onclick='deleteProperty($i)'>Usuń</label></div>";
                            $i++;
                        }
                    } else $i = 0;
                    echo "<div id='property$i' style='margin-bottom: 15px;'><input type='text' value='' name='propertyType$i' id='propertyType$i' onchange='addNewProperty($i)' class='propertyType'>
                        <label id='boldColon'> : </label>
                        <input type='text' value='' name='propertyTypeValue$i' id='propertyTypeValue$i' onchange='addNewProperty($i)' class='propertyTypeValue'>
                    <label class='deleteProperyLabel' onclick='deleteProperty($i)'>Usuń</label></div>";
                ?>
            </div>
            <label class="boldLabel">* Kategoria (np. Elektornika)</label><br>
            <select class="categorySelect">
                <?php if(isset($_POST['productId'])) echo "<option>Aktualna</option>"; ?>
                <optgroup label="Kategorie">
                    <?php showCategories(); ?>
                </optgroup>
            </select><br>
            <label class="boldLabel">* Opis produktu</label><br>
            <textarea name="productRegularPrice" class="productDescriptionArea"><?php echo $productEditData['product_description']; ?></textarea><br><br>
            <input type="submit" value="ZAPISZ" style="margin-left: 20px;">
        </form>
    </div>




    <?php
        echo <<< html
            <div class="loggedUserMenu" id="logg">
                <div class="loggedUserMenuArrow"></div>
                <div class="accountButtonsDiv" onclick='window.location="../account/index.php";'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                    <label>KONTO</label>
                </div>
                <div class="accountButtonsDiv" style="margin-top: 0;" onclick='window.location="../php/logOutUser.php";'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="white" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                    </svg>
                    <label>WYLOGUJ</label>
                </div>
            </div>
        html;
    ?>
    
</body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="../MainPageSCRIPT.js"></script>
    <script>

        function productImageDelete(id) {
            if(document.getElementById("editImageLabel" + (id)).innerHTML != "Dodaj")
                document.getElementById("productGotImageContainer" + (id)).remove();
        }

        function productImageChanged(id) {
            if(document.getElementById("editImageLabel" + (id)).innerHTML == "Dodaj") {
                const imageContainer = document.createElement("div");
                imageContainer.className = "productGotImageContainer";
                imageContainer.id = "productGotImageContainer" + (id+1);
                const img = document.createElement("img");
                img.className = "productGotImage";
                const uploadInput = document.createElement("input");
                uploadInput.type = "file";
                uploadInput.name = "productImage" + (id+1);
                uploadInput.className = "upload-photo";
                uploadInput.id = "upload-photo" + (id+1);
                uploadInput.setAttribute("onchange","productImageChanged("+(id+1)+");");
                const deleteLabel = document.createElement("label");
                deleteLabel.className = "productImageDeleteLabel";
                deleteLabel.setAttribute("onclick","productImageDelete("+(id+1)+");");
                deleteLabel.innerHTML = "Usuń";
                const addLabel = document.createElement("label");
                addLabel.htmlFor = "upload-photo" + (id+1);
                addLabel.id = "editImageLabel" + (id+1);
                addLabel.className = "productImageEditLabel";
                addLabel.innerHTML = "Dodaj";

                imageContainer.appendChild(img);
                imageContainer.appendChild(uploadInput);
                imageContainer.appendChild(deleteLabel);
                imageContainer.appendChild(addLabel);
                document.getElementById("imagesContainerId").append(imageContainer);
            }
            if(event.target.value != "")
                document.getElementById("editImageLabel" + id).innerHTML = event.target.value;
            else {
                document.getElementById("editImageLabel" + id).innerHTML = "Edytuj";
                event.target.value = "image" + id;
            }
        }

        function addNewProperty(id) {
            var highterProperty =  document.getElementById('property' + (id+1));
            if(highterProperty == null) {
                const propertyContainer = document.createElement("div");
                propertyContainer.id = "property" + (id+1);
                propertyContainer.style.marginBottom = "15px";
                const propertyType = document.createElement("input");
                propertyType.type = "text";
                propertyType.name = "propertyType" + (id+1);
                propertyType.id = "propertyType" + (id+1);
                propertyType.className = "propertyType";
                propertyType.setAttribute("onchange","addNewProperty("+(id+1)+");");
                const boldColon = document.createElement("label");
                boldColon.innerHTML = " : ";
                boldColon.id = "boldColon";
                boldColon.style.marginLeft = "-1px";
                const propertyTypeValue = document.createElement("input");
                propertyTypeValue.type = "text";
                propertyTypeValue.name = "propertyTypeValue" + (id+1);
                propertyTypeValue.id = "propertyTypeValue" + (id+1);
                propertyTypeValue.className = "propertyTypeValue";
                propertyTypeValue.style.marginLeft = "-1px";
                propertyTypeValue.setAttribute("onchange","addNewProperty("+(id+1)+");");
                const deleteLabel = document.createElement("label");
                deleteLabel.className = "deleteProperyLabel";
                deleteLabel.innerHTML = "Usuń";
                deleteLabel.style.marginLeft = "4px";
                deleteLabel.setAttribute("onclick","deleteProperty("+(id+1)+");");

                propertyContainer.appendChild(propertyType);
                propertyContainer.appendChild(boldColon);
                propertyContainer.appendChild(propertyTypeValue);
                propertyContainer.appendChild(deleteLabel);
                document.getElementById("productPropertyContainerId").append(propertyContainer);
            }
        }

        function deleteProperty(id) {
            if(document.getElementById("propertyTypeValue" + (id)).value != "" || document.getElementById("propertyType" + (id)).value != "")
                document.getElementById("property" + (id)).remove();
        }

    </script>
</html>