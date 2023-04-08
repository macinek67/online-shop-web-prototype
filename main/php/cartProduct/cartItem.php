<style>
    <?php include 'cartItemStyles.css'; ?>
</style>

<?php

class CartItem {
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
            <div class="cartItemMainDiv">
            <img src="$img">
            <label class="cartItemTitle">$title</label>
            <input type="number" min="1" value="1">
            <label class="cartItemPrice">$price zł</label>
            <form action="../php/cartProduct/deleteCartProduct.php" method="POST">
                <input type="hidden" name="id" value="$this->id">
                <input type="submit" name="deleteSubmit" value="" class="">
            </form>
            </div>
        html;
    }

}

?>