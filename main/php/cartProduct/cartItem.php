<style>
    <?php include 'cartItemStyles.css'; ?>
</style>

<?php

class CartItem {
    public $product;
  
    function __construct(Product $product) {
        $this->product = $product;
    }

    function createProduct() {
        $img = $this->product->imgUrl;
        $title = $this->product->title;
        $price = $this->product->price;
        echo <<< html
        <div class="cartItemMainDiv">
        <img src="$img">
        <label class="cartItemTitle">$title</label>
        <input type="number" min="1" value="1">
        <label class="cartItemPrice">$price zł</label>
        <form>
            <input type="submit" value="" class="">
        </form>
        </div>
        html;
    }

}

?>