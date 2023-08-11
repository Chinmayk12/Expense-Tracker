<?php
    session_start();
    include './inc/Medoo.php';
    use Medoo\Medoo;

    $database = new Medoo([
        'type' => 'mysql',
        'database' => 'expenses',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
   ]);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $confpassword = $_POST['confpassword']; 
    $photo = $_FILES['photo'];

    // $existingFolderPath = 'uploads/users';  //uploads/users
    // $newFolderName = $mobile;   //8010944027

    // $newFolderPath = $existingFolderPath . '/' . $newFolderName; //uploads/users/8010944027

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

    $photoName = $photo['name'];
    $photoTmpName = $photo['tmp_name'];
    $folderpath = 'uploads/users/';
    // $foldername = 'users/'.$mobile.'/';
    // $folder = $folderpath . $foldername;
    $photoPath = $folderpath.$name.'-'.$mobile."-userprofile-".time()."-". $photoName;   // Creating a dynamic name
    move_uploaded_file($photoTmpName, $photoPath);

    $database->insert("users", [
        "name" => $name,
        "email" => $email,
        "mobile" => $mobile,
        "password" => $password,
        "confpassword" => $password,
        "photo" => $photoPath, 
        ]);

    if ($password == $confpassword) 
    {
        if ($database) {
            echo "<script>alert('Sign In Successfully')</script>"; // Data Inserted
            echo "<script>window.location.href='index.php'</script>";
        } else {
            echo "<script>alert('An Error Occurred During Sign In')</script>"; // Data Not Inserted
        }
    } else {
        echo "<script>alert('Please Enter the Same Password in Both Fields')</script>";
        echo "<script>window.location.href='signup.php'</script>";
    }
?>
