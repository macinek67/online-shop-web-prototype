<style>
    <?php include 'searchedItemStyles.css'; ?>
</style>

<?php

class SearchedItem {
    public $product;
  
    function __construct(Product $product) {
        $this->product = $product;
    }

    function createProduct() {
        $img = $this->product->imgUrl;
        $title = $this->product->title;
        $price = $this->product->price;
        $id = $this->product->id;
        $connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");
        $result = $connect->query("SELECT product_boughtCount FROM product WHERE product_id='$id' LIMIT 1");
        $popularity = 0;
        if($row = mysqli_fetch_assoc($result)) {
            $popularity = $row['product_boughtCount'];
        }
        echo <<< html
            <div class="searchedItemMainDiv">
                <input type="hidden" name="id" value="$id">
                <div class="searchedItemImageAndTitleContainer">
                    <img src="$img">
                    <label class="searchedItemTitle" onclick="">$title</label>
                </div>
                <div class="searchedItemProperties">
                    <label>Kolor: niebieski</label>
                    <label>Kolor: niebieski</label>
                    <label>Kolor: niebieski</label>
                    <label>Kolor: niebieski</label>
                    <label>Kolor: niebieskiyy</label>
                    <label>Kolor: niebieski</label>
                    <label>Kolor: niebieski</label>
                    <label>Kolor: niebieski</label>
                    <label>Kolor: niebieski</label>
                    <label>Kolor: niebieski</label>
                    <label>Kolor: niebieski</label>
                    <label>Kolor: niebieski</label>
                </div>
                <label class="searchedItemPrice">$price zł</label><br>
                <label class="searchedItemBoughtCount">Kupiono $popularity razy</label>
                <form action="../php/favoriteProduct/deleteFavoriteProduct.php" method="POST">
                    <input type="hidden" name="id" value="$id">
                </form>
            </div>
        html;
    }
}

?>