<?php

include 'header-data.php';

    

if (isset($_POST['sub']))
{
    
    $acct_name= $_POST['acct_name'];
    $acct_number= $_POST['acct_number'];
    $bank_name= $_POST['bank_name'];
    $branch= $_POST['branch'];
    $ifsc_code= $_POST['ifsc_code'];
    $micr_code= $_POST['micr_code'];

    //$insertResult = $database->insert('bank_details', ['acct_name' => $acct_name  , 'acct_number' => $acct_number , 'bank_name' => $bank_name , 'branch' => $branch ,'ifsc_code' => $ifsc_code ,'micr_code' => $micr_code ]);
    
    $insertResult = $database->insert('bank_details', [
        'acct_name' => $acct_name,
        'acct_number' => $acct_number,
        'bank_name' => $bank_name,
        'branch' => $branch,
        'ifsc_code' => $ifsc_code,
        'micr_code' => $micr_code,
        'user_id' => $user['id'],
    ]);
    
    if ($insertResult) {
        echo "<script>alert('Record Inserted Successfully')</script>";
        echo "<script>window.location='add-bank-details.php'</script>";
    } else {
        echo "Record Not Inserted<br>";
        //echo "Error: " . $database->error()[2];
    }
            
}

else
{
    echo "<script>alert('Record  Not Inserted')</script>";
    echo "<script>window.location='add-bank-details.php'</script>";
}
?>