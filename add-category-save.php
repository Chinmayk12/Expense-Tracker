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
        // Insert data into 'groups' table
        $insertResult = $database->insert('categories', [
            'category_name' => $category,
            'user_id' => $user['id'],
        ]);
        
        if ($insertResult)
        {
            echo "<script>alert('Record Inserted Successfully')</script>";
            echo "<script>window.location='add-category.php'</script>";
        } else 
        {
            echo "Record Not Inserted<br>";
            //echo "Error: " . $database->error()[2];
        }           
    }
    else
    {
        echo "<script>alert('Record  Not Inserted')</script>";
        echo "<script>window.location='add-category.php'</script>";
    }
?>