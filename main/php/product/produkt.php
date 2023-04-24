
<?php

class Product {
    public $id;
    public $title;
    public $price;
    public $imgUrl;
  
    function __construct($id, $title, $price, $imgUrl) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->imgUrl = $imgUrl;
        // $connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");
        // $result = $connect->query("INSERT INTO product(product_title, product_price, product_description, product_img) VALUES('$this->title','$this->price', '', '$this->imgUrl')");
        // $connect->close();
    }

    function createProduct() {
        echo <<< html
        <div class="productDiv">
            <form action="productPage/index.php" method="POST">
                <img src="$this->imgUrl">
                <label>$this->title</label>
                <label class="productPrice">$this->price zł</label>
                <input type="hidden" name="id" value="$this->id">
                <input type="submit" value="ZOBACZ" class="viewItemButton">
            </form>
        </div>
        html;
    }

}
