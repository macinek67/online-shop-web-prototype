<style>
    <?php include 'searchedCategoryStyles.css'; ?>
</style>

<?php

class searchedCategory {
    public $id;
  
    function __construct($id) {
        $this->id = $id;
    }

    function createView() {
        $connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");
        $result = $connect->query("SELECT * FROM category WHERE category_id='$this->id'");
        if($row = mysqli_fetch_assoc($result)) {
            echo <<< html
                <div class="searchedCategoryViewContainer">
                    <label class="categoryIdLabel">#$this->id</label>
                    <label class="categoryNameLabel">$row[name]</label>
                    <label class="categoryToEditLabel" onclick='editCategoryRequest($this->id)'>Edytuj</label>
            html;
                    $result = $connect->query("SELECT * FROM product WHERE category_id='$this->id' AND isSuspended='no'");
                    if(!($row = mysqli_fetch_assoc($result))) echo "<label class='categoryToDeleteDLabel' onclick='deleteCategoryRequest(7)'>Usuń</label>";
                    else echo "<label class='categoryToDeleteDLabelDisabled'>Usuń</label>";
                echo "</div>";
        }
    }

}


?>