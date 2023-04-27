
<?php

class Product {
    public $id;
    public $title;
    public $price;
    public $imgUrl;
    public $mainImg;
  
    function __construct($id, $title, $price) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");
        $result = $connect->query("SELECT * FROM product WHERE product_id='$this->id'");
        if($row = mysqli_fetch_assoc($result)) {
            $this->mainImg = unserialize($row['product_img'])[0];
        }
    }

    function createProduct() {
        echo <<< html
        <div class="productDiv">
            <form action="productPage/index.php" method="POST">
                <img src="../uploadedProductImages/$this->mainImg">
                <label>$this->title</label>
                <label class="productPrice">$this->price zł</label>
                <input type="hidden" name="id" value="$this->id">
                <input type="submit" value="ZOBACZ" class="viewItemButton">
            </form>
        </div>
        html;
    }

}
