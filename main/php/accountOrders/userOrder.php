<style>
    <?php include 'userOrderStyles.css'; ?>
</style>

<?php

    function createOrderView() {
        $connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");
        $userID = $_SESSION["user"]['user_id'];
        $userOrders = $connect->query("SELECT * FROM orders WHERE user_id=$userID ORDER BY id DESC");
        while($order = mysqli_fetch_assoc($userOrders)) {
            $status = $order['status'];
            $orderDate = explode('-', $order['order_date']);
            $orderId = $order['id'];
            $orderValue = $order['order_value'];
            $orderProductsArray = unserialize($order['ordered_products']);
            $orderMonths = ["stycznia", "lutego", "marca", "kwietnia", "maja", "czerwca", "lipca", "sierpnia", "września", "października", "listopada", "grudnia"];
            $orderMonth = $orderMonths[$orderDate[1]-1];
            $orderNumber = "";
            for($i=0; $i<12-strlen($orderId); $i++)
                $orderNumber = $orderNumber . "0";
            $orderNumber = $orderNumber . $orderId;
            echo <<< html
            <div class="userOrderItemContainer">
                <div class="userOrderLeftInfo">
                    <label class="statusLabel">$status</label><br>
                    <label class="datelabel">$orderDate[2] $orderMonth $orderDate[0]</label><br>
                    <label class="numberLabel">nr $orderNumber</label><br>
                    <label class="valueLabel">$orderValue zł</label><br>
                </div>
                <div class="userOrderRightPhotos">
            html;
            foreach ($orderProductsArray as &$product) {
                $productId = $product['product_id'];
                $orderedProduct = $connect->query("SELECT * FROM product WHERE product_id='$productId' LIMIT 1");
                if($row = mysqli_fetch_assoc($orderedProduct))
                    $orderedProductImage = $row['product_img'];
                echo "<img src='$orderedProductImage' class='productImage'>";
            }
            echo <<< html
                </div>
            </div>
            html;
        }
    }

?>