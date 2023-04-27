<style>
    <?php include 'favoriteItemStyles.css'; ?>
</style>

<?php

class FavoriteItem {
    public $id;
    public $product;
    public $mainImg;
  
    function __construct($id, Product $product) {
        $this->id = $id;
        $this->product = $product;
    }

    function createProduct() {
        $title = $this->product->title;
        $price = $this->product->price;
        $connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");
        $result = $connect->query("SELECT * FROM product WHERE product_id='$this->id'");
        if($row = mysqli_fetch_assoc($result)) {
            $this->mainImg = unserialize($row['product_img'])[0];
        }
        echo <<< html
            <div class="favoriteItemMainDiv">
                <form method="POST" id="goToProductPageForm" action="../productPage/index.php" style="position: absolute; visibility: hidden;">
                    <input type="hidden" id="goToProductId" name="id" value="$this->id">
                </form>
                <img src="../../uploadedProductImages/$this->mainImg">
                <label class="favoriteItemTitle" onclick="goToProductPage($this->id)">$title</label>
                <label class="favoriteItemPrice">$price zł</label>
                <form action="../php/favoriteProduct/deleteFavoriteProduct.php" method="POST">
                    <input type="hidden" name="id" value="$this->id">
                    <input type="submit" name="deleteSubmit" value="" class="">
                </form>
            </div>
        html;
    }

}

?>