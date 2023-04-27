<style>
    <?php include 'searchedItemStyles.css'; ?>
</style>

<?php

class SearchedItem {
    public $product;
    public $mainImg;
    public $id;
  
    function __construct(Product $product) {
        $this->product = $product;
    }

    function createProduct() {
        $title = $this->product->title;
        $price = $this->product->price;
        $this->id = $this->product->id;
        $connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");
        $result = $connect->query("SELECT * FROM product WHERE product_id='$this->id'");
        if($row = mysqli_fetch_assoc($result)) {
            $this->mainImg = unserialize($row['product_img'])[0];
            $popularity = $row['product_boughtCount'];
            $propertiesArray = unserialize($row['product_properties']);
        }
        echo <<< html
            <div class="searchedItemMainDiv" onclick="goToProductPage($this->id)">
                <form method="POST" id="goToProductPageForm" action="../productPage/index.php" style="position: absolute; visibility: hidden;">
                    <input type="hidden" id="goToProductId" name="id" value="$this->id">
                </form>
                <div class="searchedItemImageAndTitleContainer">
                    <img src="../../uploadedProductImages/$this->mainImg">
                    <label class="searchedItemTitle">$title</label>
                </div>
                <div class="searchedItemProperties">
        html;
                foreach ($propertiesArray as &$productProperty) {
                        echo "<label>$productProperty[0]: $productProperty[1]</label>";
                }
        echo <<< html
                </div>
                <label class="searchedItemPrice">$price zł</label><br>
                <label class="searchedItemBoughtCount">Kupiono $popularity razy</label>
            </div>
        html;
    }
}

?>