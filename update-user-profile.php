<?php
include 'header-data.php';

if(!isset($_SESSION['user']))
{
    echo "<script>window.location='index.php'</script>";
    exit;
}

$name = $_POST['fname'];
$mobile = $_POST['mobileno'];
$email = $_POST['email'];
$photo = $_FILES['photo'];

$photoPath = null; // Set a default value for $photoPath

if (isset($photo) && $photo['error'] === UPLOAD_ERR_OK) 
{
    // A new photo is uploaded, update the photo as well
    $photoName = $photo['name'];
    $photoTmpName = $photo['tmp_name'];
    $folderpath = 'uploads/users/';
    $photoPath = $folderpath . $name . '-' . $mobile . "-updateduserprofile-" . time() . "-" . $photoName; // Creating a dynamic name
    move_uploaded_file($photoTmpName, $photoPath);

    $userprofile = $database->update('users', [
        'name' => $name,
        'mobile' => $mobile,
        'email' => $email,
        'photo' => $photoPath // Update the photo path, which could be null if no new photo is uploaded
    ], [
        'mobile' => $_SESSION['mobile']
    ]);
}
else
{
    $userprofile = $database->update('users', [
        'name' => $name,
        'mobile' => $mobile,
        'email' => $email,
        //'photo' => $photoPath // Update the photo path, which could be null if no new photo is uploaded
    ], [
        'mobile' => $_SESSION['mobile']
    ]);
}


if ($database) {
    echo "<script>alert('Profile updated successfully.. Login Again')</script>";
    $_SESSION['mobile'] = $mobile;
    echo "<script>window.location='index.php'</script>";
} else {
    echo "<script>alert('Profile not updated')</script>";
}
?>
