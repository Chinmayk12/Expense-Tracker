<?php
include 'header-data.php';
if(!isset($_SESSION['user']))
{
    echo "<script>window.location='index.php'</script>";
    exit;
}

if (isset($_POST['sub']))
{
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];

    $category_id = $database->select('categories', 'category_id', ['category_name' => $category , 'user_id' => $user['id']]);

    if (!empty($category_id))
    {
        $category_id1 = $category_id[0];
    }
    
    $insertResult = $database->insert('categories', ['category_name' => $subcategory,'parent_id' => $category_id1,'user_id' => $user['id']]);
    //$insertResult = $database->insert('categories', $data);
    
    if ($insertResult)
    {
        echo "<script>alert('Record Inserted Successfully')</script>";
        echo "<script>window.location='add-subcategory.php'</script>";
    } 
    else
    {
        echo "Record Not Inserted<br>";
        //echo "Error: " . $database->error()[2];
    }
    
   
            
}

else
{
    echo "<script>alert('Record  Not Inserted')</script>";
    echo "<script>window.location='add-subcategory.php'</script>";
}



?>