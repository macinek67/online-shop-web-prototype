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
        echo <<< html
            <div class="favoriteItemMainDiv">
            <input type="hidden" name="id" value="$id">
            <img src="$img">
            <label class="favoriteItemTitle" onclick="">$title</label>
            <label class="favoriteItemPrice">$price zł</label>
            <form action="../php/favoriteProduct/deleteFavoriteProduct.php" method="POST">
                <input type="hidden" name="id" value="$id">
            </form>
            </div>
        html;
    }
}

?>