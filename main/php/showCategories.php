<?php

function showCategories() {
    $connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");
    $result = $connect->query("SELECT name FROM category");
    while($row = mysqli_fetch_assoc($result)) {
        echo "<option>" . $row['name'] . "</option>";
    }
}

?>