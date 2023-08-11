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
    
        // Delete the record from the database
        $database->delete('income', ['id' => $deleteId]);
    
        // Redirect to the same page to refresh the record list
        //echo "<script>alert('Record Deleted')</script>";
        echo "<script>window.location='income-records.php'</script>";
        exit;
    }
?>