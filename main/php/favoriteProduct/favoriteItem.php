<style>
    <?php include 'favoriteItemStyles.css'; ?>
</style>

<?php

class FavoriteItem {
    public $id;
    public $product;
  
    function __construct($id, Product $product) {
        $this->id = $id;
        $this->product = $product;
    }

    function createProduct() {
        $img = $this->product->imgUrl;
        $title = $this->product->title;
        $price = $this->product->price;
        echo <<< html
            <div class="favoriteItemMainDiv">
            <input type="hidden" name="id" value="$this->id">
            <img src="$img">
            <label class="favoriteItemTitle" onclick="">$title</label>
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