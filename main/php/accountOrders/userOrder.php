<style>
    <?php include 'userOrderStyles.css'; ?>
</style>

<?php

class userOrder {
    public $products;
  
    function __construct($products) {
        $this->products = $products;
    }

    function createOrderView() {
        $orderProductsArray = unserialize($this->products); 
        print_r($orderProductsArray);
        echo $orderProductsArray[0]['product_id'];
    }
}

?>