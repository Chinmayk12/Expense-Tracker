<?php
include 'header-data.php';
if (isset($_GET['category_id'])) {
    $selectedCategoryId = $_GET['category_id'];

    // Fetch subcategories for the selected category from the database
    $subcategories = $database->select('categories', ['category_id', 'category_name'], ['parent_id' => $selectedCategoryId]);

    // Add the "None" option
    echo '<option value="None">None</option>';

    foreach($subcategories as $sc) {
        echo "<option value='".$sc['category_id']."'>".$sc['category_name']."</option>";
    }
}
?>
