
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

$product2 = new Product("Samsung Galaxy S22 5G SM-S901 8/128GB Czarny", "2798.00", "https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/35/3508342/Smartfon-SAMSUNG-Galaxy-S22-Czarny-tyl-front.jpg");

$product3 = new Product("Procesor AMD Ryzen 9 5900X, 3.7 GHz, 64 MB, BOX (100-100000061WOF)", "1570.11", "https://images.morele.net/i1064/7267022_0_i1064.jpg");

$product4 = new Product("XFX Speedster MERC319 AMD Radeon RX 6800 XT CORE karta graficzna do gier z 16 GB GDDR6 HDMI 3 x DP RX-68XTALFD9", "2893.11", "https://m.media-amazon.com/images/I/81-70VBUexL._AC_SL1500_.jpg");

$product5 = new Product("Gigabyte B650 AORUS ELITE AX", "1249.00", "https://cdn.x-kom.pl/i/setup/images/prod/big/product-new-big,,2022/10/pr_2022_10_10_9_40_29_690_02.jpg");