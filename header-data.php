<?php
    session_start();
    use Medoo\Medoo;
    include './inc/Medoo.php';
    
    $user = $_SESSION['user'];    
    $mobileno = $user['mobile'];
   
    $database = new Medoo
    ([
        'type' => 'mysql',
        'database' => 'expenses',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
    ]);
    
    $data = $user;
    $photo = $data['photo'];
    $name = $data['name'];
?>