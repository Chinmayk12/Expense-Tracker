<?php
    include 'header.php';
    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
        exit;
    }
?>
<?php
    $group = $_POST['group'];
    $incomedate = $_POST['incomedate'];
    $amount= $_POST['amount'];
    $mode_of_income= $_POST['moi'];
    $bank= $_POST['bank'];
    $details= $_POST['details'];
    $payment_details= $_POST['payment_details'];
    $photo = $_FILES['photo'];
    //echo "<script>alert('$group $date $amount $mode_of_income $bank $details $payment_details $receipt')</script>";
    //$existingFolderPath = 'uploads/users/9699424463/';  //uploads/users/8010944027
    
    // $existingFolderPath = 'uploads/users/'.$mobileno.'/';  //uploads/users/8010944027
    // $newFolderName = 'incomes';   // incomes

    // $newFolderPath = $existingFolderPath . '/' . $newFolderName; //uploads/users/8010944027/incomes

    // if (!is_dir($newFolderPath)) 
    // {
    //     // Create the new folder
    //     if (mkdir($newFolderPath, 0777, true)) 
    //     {
    //         //echo 'New folder created successfully.';
    //     } else 
    //     {
    //         //echo 'Unable to create new folder.';
    //     }
    // } else 
    // {
    //     //echo 'Folder already exists.';
    // }
    if(isset($photo) && $photo['error'] === UPLOAD_ERR_OK)
    {
        $photoName = $photo['name'];
        $photoTmpName = $photo['tmp_name'];
        $folderpath = 'uploads/users/';   // folder path to find in which folder path we want to add photo in that perticular folder
        // $foldername = 'expenses/';                      // Providing a foldername in which a photo is going to store
        //$folder = $folderpath . $foldername;
        $photoPath = $folderpath. $user['id'] ."-income-".time()."-". $photoName;
        move_uploaded_file($photoTmpName, $photoPath);
    
        $insertData = [
            'group' => $group,
            'date' => $incomedate,
            'amount'=>$amount, 
            'mode' => $mode_of_income,
            'bank' => $bank,
            'details' => $details,
            'payment_details' => $payment_details,
            'receipt' => $photoPath,
            'user_id' =>$user['id'],
        ];
    }
    else
    {
        if($mode_of_income=="Cash")
        {
            $staticImagePath = 'assets/images/expense_image_not_available.jpg';
        
        }
        elseif($mode_of_income=="Online")
        {
            $staticImagePath = 'assets/images/no_receipt.jpeg';

        }
        elseif($mode_of_income=="Check")
        {
            $staticImagePath = 'assets/images/payment_done_in_check.jpeg';
        }
       
        // $staticImagePath = 'assets/images/expense_image_not_available.jpg';
        
        $folderpath = 'uploads/users/';
        $photoPath = $folderpath . $user['id'] . "-expense-" . time() . "-" . basename($staticImagePath);

        // Copy the static image to the desired location
        copy($staticImagePath, $photoPath);

        $insertData = [
            'group' => $group,
            'date' => $incomedate,
            'amount'=>$amount, 
            'mode' => $mode_of_income,
            'bank' => $bank,
            'details' => $details,
            'payment_details' => $payment_details,
            'receipt' => $photoPath,
            'user_id' =>$user['id'],
        ];
    }
   
    try 
    {
        $insertResult = $database->insert('income', $insertData);
    
        // Check if the insert operation was successful
        if ($insertResult !== false) 
        {
            echo "<script>alert('Income Added')</script>";
            echo "<script>window.location='add-income.php'</script>";
        } 
        else 
        {
            echo "<script>alert('Income Not Inserted')</script>";
            echo "<script>window.location='add-income.php'</script>";
        }
    } catch (Exception $e) 
    {
        echo "Error: " . $e->getMessage();
    }
?>
