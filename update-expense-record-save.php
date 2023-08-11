<?php
    include 'header-data.php';

    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
	    exit;
    }
    
    $user_id = $user['id'];

    $accounts = $_POST['accounts'];
    $group = $_POST['group'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $expensedate = $_POST['expensedate'];
    $mode_of_payment= $_POST['mop'];
    $bank= $_POST['bank'];
    $amount= $_POST['amount'];
    $details= $_POST['details'];
    $rate= $_POST['rate'];
    $quantity= $_POST['qty'];
    $payment_details= $_POST['payment_details'];
    $payment_status= $_POST['payment_status'];
    $expenseid = $_GET['id'];

    if(!empty($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK)
    {
        $photo = $_FILES['photo'];
        $photoName = $photo['name'];
        $photoTmpName = $photo['tmp_name'];
        $folderpath = 'uploads/users/';   // folder path to find in which folder path we want to add photo in that perticular folder
        // $foldername = 'expenses/';                      // Providing a foldername in which a photo is going to store
        //$folder = $folderpath . $foldername;
        $photoPath = $folderpath. $user['id'] ."-expense-".time()."-". $photoName;
        move_uploaded_file($photoTmpName, $photoPath);

        $statement = $database->update('expenses', [
            'accounts' => $accounts,
            'group' => $group,
            'category' => $category,
            'subcategory' => $subcategory,
            'date' => $expensedate,
            'mode' => $mode_of_payment,
            'bank' => $bank,
            'amount' => $amount,
            'details' => $details,
            'rate' => $rate,
            'quantity' => $quantity,
            'payment_details' => $payment_details,
            'payment_status' => $payment_status,
            'receipt' => $photoPath,
        ], [
            'user_id' => $user_id,
            'id' => $expenseid,
        ]);
        
    }
    elseif($mode_of_payment=='Cash')
    {
        $staticImagePath = 'assets/images/expense_image_not_available.jpg';
        
        $folderpath = 'uploads/users/';
        $photoPath = $folderpath . $user['id'] . "-expense-" . time() . "-" . basename($staticImagePath);

        // Copy the static image to the desired location
        copy($staticImagePath, $photoPath);

        $statement = $database->update('expenses', [
            'accounts' => $accounts,
            'group' => $group,
            'category' => $category,
            'subcategory' => $subcategory,
            'date' => $expensedate,
            'mode' => $mode_of_payment,
            'bank' => $bank,
            'amount' => $amount,
            'details' => $details,
            'rate' => $rate,
            'quantity' => $quantity,
            'payment_details' => $payment_details,
            'payment_status' => $payment_status,
            'receipt'=>$photoPath
        ], [
            'user_id' =>$user_id,
            'id' => $expenseid,
        ]);
    }
    elseif($mode_of_payment=='Check')
    {
        $staticImagePath = 'assets/images/payment_done_in_check.jpeg';
        
        $folderpath = 'uploads/users/';
        $photoPath = $folderpath . $user['id'] . "-expense-" . time() . "-" . basename($staticImagePath);

        // Copy the static image to the desired location
        copy($staticImagePath, $photoPath);

        $statement = $database->update('expenses', [
            'accounts' => $accounts,
            'group' => $group,
            'category' => $category,
            'subcategory' => $subcategory,
            'date' => $expensedate,
            'mode' => $mode_of_payment,
            'bank' => $bank,
            'amount' => $amount,
            'details' => $details,
            'rate' => $rate,
            'quantity' => $quantity,
            'payment_details' => $payment_details,
            'payment_status' => $payment_status,
            'receipt'=>$photoPath
        ], [
            'user_id' =>$user_id,
            'id' => $expenseid,
        ]);
    }
    else
    {
        $staticImagePath = 'assets/images/no_receipt.jpeg';
        
        $folderpath = 'uploads/users/';
        $photoPath = $folderpath . $user['id'] . "-expense-" . time() . "-" . basename($staticImagePath);

        // Copy the static image to the desired location
        copy($staticImagePath, $photoPath);
        $statement = $database->update('expenses', [
            'accounts' => $accounts,
            'group' => $group,
            'category' => $category,
            'subcategory' => $subcategory,
            'date' => $expensedate,
            'mode' => $mode_of_payment,
            'bank' => $bank,
            'amount' => $amount,
            'details' => $details,
            'rate' => $rate,
            'quantity' => $quantity,
            'payment_details' => $payment_details,
            'payment_status' => $payment_status,
            'receipt'=>$photoPath
        ], [
            'user_id' =>$user_id,
            'id' => $expenseid,
        ]);
        
    }

    // Check if the update was successful
    $affectedRows = $statement->rowCount();

    // Check if the update was successful
    if ($affectedRows>0) 
    {
        echo "<script>alert('Record updated successfully')</script>";
        echo "<script>window.location.href='expense-records.php'</script>";
    }
    else 
    {
        echo "<script>alert('Record not updated')</script>";
        echo "<script>window.location.href='expense-records.php'</script>";
    }
   
?>