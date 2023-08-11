<?php
    include 'header-data.php';
    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
        exit;
    }
?>
<?php
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
    $payment_status= $_POST['p_status'];
    // // Convert the date string to a DateTime object
    // $dateTime = new DateTime($expensedate);
    
    // // Get the month name from the DateTime object
    // $currentMonthName = $dateTime->format('F');

    

    //$receipt = $_POST['photo'];
   
    //echo "<script>alert('$accounts $group $category $subcategory $expensedate $mode_of_payment $bank $amount $details $rate $quantity $payment_details $payment_status $receipt')</script>";

    // $existingFolderPath = 'uploads/users/'.$mobileno.'/';  //uploads/users/8010944027
    // $newFolderName = 'expenses';   // incomes

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
    //if(isset($photo) && $photo['error'] === UPLOAD_ERR_OK)
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

        $insertData = [
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
            'user_id' =>$user['id'],
        ];
    }
    else
    {
        // $photo = $_FILES['photo'];
        // $photoName = $photo['name'];
        // $photoTmpName = $photo['tmp_name'];
        // $folderpath = 'uploads/users/';   // folder path to find in which folder path we want to add photo in that perticular folder
        // // $foldername = 'expenses/';                      // Providing a foldername in which a photo is going to store
        // //$folder = $folderpath . $foldername;
        // $photoPath = $folderpath. $user['id'] ."-expense-".time()."-". $photoName;
        // move_uploaded_file($photoTmpName, $photoPath);

        if($mode_of_payment=="Cash")
        {
            $staticImagePath = 'assets/images/expense_image_not_available.jpg';
        
        }
        elseif($mode_of_payment=="Online")
        {
            $staticImagePath = 'assets/images/no_receipt.jpeg';

        }
        elseif($mode_of_payment=="Check")
        {
            $staticImagePath = 'assets/images/payment_done_in_check.jpeg';
        }
       
        // $staticImagePath = 'assets/images/expense_image_not_available.jpg';
        
        $folderpath = 'uploads/users/';
        $photoPath = $folderpath . $user['id'] . "-expense-" . time() . "-" . basename($staticImagePath);

        // Copy the static image to the desired location
        copy($staticImagePath, $photoPath);

        $insertData = [
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
            'user_id' =>$user['id'],
        ];
    }
    
    try 
    {
        $insertResult = $database->insert('expenses', $insertData);
    
        // Check if the insert operation was successful
        if ($insertResult !== false) 
        {
            echo "<script>alert('Expense Added')</script>";
            echo "<script>window.location='add-expense.php'</script>";
        } 
        else 
        {
            echo "<script>alert('Expense Not Added')</script>";
            echo "<script>window.location='add-expense.php'</script>";
        }
    } catch (Exception $e) 
    {
        echo "Error: " . $e->getMessage();
    }
?>