<?php
    include 'header-data.php';

    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
	    exit;
    }
  
    $deleteId = $_SESSION['account_id'];
    $user_id = $user['id'];

    $account_name = $_GET['acct_name'];
    $account_number = $_GET['acc_no'];
    $account_email = $_GET['account_email'];

    // Delete the record from the database
    $statement = $database->update('accounts', [
        'account_name' => $account_name,
        'account_number' => $account_number,
        'email' => $account_email,
    ], [
        'id' => $deleteId,
        'user_id' => $user_id,
    ]);
    
    $affectedRows = $statement->rowCount();
    if($affectedRows)
    {
        echo "<script>alert('Record Updated Successfully')</script>";
        echo "<script>window.location='add-account-details.php'</script>";
        exit;
    }
    else
    {
        echo "<script>alert('Record Not Updated')</script>";
        echo "<script>window.location='add-account-details.php'</script>";
    }
?>