<?php
    include 'header-data.php';

    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
        exit;
    }
    
    if (isset($_GET['id'])) 
    {
        $deleteId = $_GET['id'];
        $user_id = $user['id'];
    
        // Delete the record from the database
        $result = $database->delete('accounts', [
            'id' => $deleteId,
            'user_id' => $user_id,
        ]);
        
        if($result)
        {
            //echo "<script>alert('Record Deleted')</script>";
            echo "<script>window.location='add-account-details.php'</script>";
            exit;
        }
        else
        {
            echo "<script>alert('Record Not Deleted')</script>";
            echo "<script>window.location='add-account-details.php'</script>";
        }
    
    }
?>