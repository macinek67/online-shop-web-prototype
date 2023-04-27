<style>
    <?php include 'cartItemStyles.css'; ?>
</style>

<?php

class CartItem {
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
        $quantity = 1;
        $connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");
        $userId = $_SESSION["user"]['user_id'];
        $result = $connect->query("SELECT * FROM cartproduct WHERE user_id='$userId' AND product_id='$this->id' LIMIT 1");
        if($row = mysqli_fetch_assoc($result)) {
            if($row["product_quantity"]>0) $quantity = $row["product_quantity"];
            else $quantity = 1;
            $result = $connect->query("UPDATE cartproduct SET product_quantity='$quantity' WHERE user_id='$userId' AND product_id='$this->id' LIMIT 1");
        }
        $result = $connect->query("SELECT * FROM product WHERE product_id='$this->id'");
        if($row = mysqli_fetch_assoc($result)) {
            $this->mainImg = unserialize($row['product_img'])[0];
        }
        echo <<< html
            <div class="cartItemMainDiv">
                <form method="POST" id="goToProductPageForm" action="../productPage/index.php" style="position: absolute; visibility: hidden;">
                    <input type="hidden" id="goToProductId" name="id" value="$this->id">
                </form>
                <img src="../../uploadedProductImages/$this->mainImg">
                <label class="cartItemTitle" onclick="goToProductPage($this->id)">$title</label>
                <input type="number" min="1" value="$quantity" onchange="changeQuantity()">
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