
<?php

class Product {
    public $title;
    public $price;
    public $imgUrl;
  
    function __construct($title, $price, $imgUrl) {
        $this->title = $title;
        $this->price = $price;
        $this->imgUrl = $imgUrl;
    }

    function createProduct() {
        echo <<< html
        <div class="productDiv">
            <form>
                <img src="$this->imgUrl">
                <label>$this->title</label>
                <label class="productPrice">$this->price zł</label>
                <input type="submit" value="ZOBACZ" class="viewItemButton">
            </form>
        </div>
        html;
    }

}

$product1 = new Product("Czajnik elektryczny Adler AD1223 srebrny 1,7l", "80.00", "https://th.bing.com/th/id/R.01f0cb36977c04ed217a327ed427c7d8?rik=IF%2b32lzjkWnOjA&pid=ImgRaw&r=0");