<?php
    include 'header-data.php';

    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
	    exit;
    }
   
    $user_id = $user['id'];
    $group = $_POST['group'];
    $incomedate = $_POST['date'];
    $mode_of_payment= $_POST['mop'];
    $bank= $_POST['bank'];
    $amount= $_POST['amount'];
    $details= $_POST['details'];
    $payment_details= $_POST['payment_details'];
    $incomeid= $_GET['id'];

    if(!empty($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK)
    {
        $photo = $_FILES['photo'];
        $photoName = $photo['name'];
        $photoTmpName = $photo['tmp_name'];
        $folderpath = 'uploads/users/';   // folder path to find in which folder path we want to add photo in that perticular folder
        // $foldername = 'expenses/';                      // Providing a foldername in which a photo is going to store
        //$folder = $folderpath . $foldername;
        $photoPath = $folderpath. $user['id'] ."-income-".time()."-". $photoName;
        move_uploaded_file($photoTmpName, $photoPath);

        $statement = $database->update('income', [
            'group' => $group,
            'date' => $incomedate,
            'mode' => $mode_of_payment,
            'bank' => $bank,
            'amount' => $amount,
            'details' => $details,
            'payment_details' => $payment_details,
            'receipt' => $photoPath,
        ], [
            'user_id' => $user_id,
            'id' =>$incomeid,
        ]);
        
    }
    elseif($mode_of_payment=='Cash')
    {
        $staticImagePath = 'assets/images/income_image_not_available.jpg';
        
        $folderpath = 'uploads/users/';
        $photoPath = $folderpath . $user['id'] . "-income-" . time() . "-" . basename($staticImagePath);

        // Copy the static image to the desired location
        copy($staticImagePath, $photoPath);

        $statement = $database->update('income', [
            'group' => $group,
            'date' => $incomedate,
            'mode' => $mode_of_payment,
            'bank' => $bank,
            'amount' => $amount,
            'details' => $details,
            'payment_details' => $payment_details,
            'receipt' => $photoPath,
        ], [
            'user_id' =>$user_id,
            'id' =>$incomeid,
        ]);
    }
    elseif($mode_of_payment=='Check')
    {
        $staticImagePath = 'assets/images/payment_done_in_check.jpeg';
        
        $folderpath = 'uploads/users/';
        $photoPath = $folderpath . $user['id'] . "-income-" . time() . "-" . basename($staticImagePath);

        // Copy the static image to the desired location
        copy($staticImagePath, $photoPath);

        $statement = $database->update('income', [
            'group' => $group,
            'date' => $incomedate,
            'mode' => $mode_of_payment,
            'bank' => $bank,
            'amount' => $amount,
            'details' => $details,
            'payment_details' => $payment_details,
            'receipt' => $photoPath,
        ], [
            'user_id' =>$user_id,
            'id' =>$incomeid,
        ]);
    }
    else
    {
        $staticImagePath = 'assets/images/no_receipt.jpeg';
        
        $folderpath = 'uploads/users/';
        $photoPath = $folderpath . $user['id'] . "-income-" . time() . "-" . basename($staticImagePath);

        // Copy the static image to the desired location
        copy($staticImagePath, $photoPath);
        $statement = $database->update('income', [
            'group' => $group,
            'date' => $incomedate,
            'mode' => $mode_of_payment,
            'bank' => $bank,
            'amount' => $amount,
            'details' => $details,
            'payment_details' => $payment_details,
            'receipt' => $photoPath,
        ], [
            'user_id' =>$user_id,
            'id' =>$incomeid,
        ]);
        
    }

    // Check if the update was successful
    $affectedRows = $statement->rowCount();

    // Check if the update was successful
    if ($affectedRows>0) 
    {
        echo "<script>alert('Record updated successfully')</script>";
        echo "<script>window.location.href='income-records.php'</script>";
    }
    else 
    {
        echo "<script>alert('Record not updated')</script>";
        //echo "<script>window.location.href='income-records.php'</script>";
    }
   
?>