<?php
     include 'header.php';
    
    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
        exit;
    }

    $acc_name = $_GET['acct_name'];
    $acc_no = $_GET['acc_no'];
    $email = $_GET['account_email'];
    
    $database->insert('accounts', [
        'account_name' => $acc_name,
        'account_number' => $acc_no,
        'email' => $email,
        'user_id'=>$user['id']
    ]);
    
    if($database)
    {
        echo "<script>alert('Account Added')</script>";
        echo "<script>window.location='add-account-details.php'</script>";
    }
    else
    {
        echo "<script>alert('Error Account Not Added')</script>";
    }

?>