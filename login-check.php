<?php
    session_start();
    include './inc/Medoo.php';
    use Medoo\Medoo;

    if (isset($_POST['mobile']) && isset($_POST['password'])) 
    {
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];

        $_SESSION['mobile'] = $mobile;

        // echo $mobile;
        // echo $password;

        $database = new Medoo
        ([
            // required
            'type' => 'mysql',
            'database' => 'expenses',
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
        ]);
        
        $userData = $database->get(
            'users',
            '*',
            ["AND"=>[
                'mobile' => $mobile,
                'password'=>$password
            ]
            ]
        );

        if($userData)
        {
            //echo "<script>alert('User Found')</script>";
            $_SESSION['user'] = $userData;
            echo "<script>alert('Login Successfully')</script>";
            echo "<script>window.location='home.php'</script>";
        }
        else
        {
            echo "<script>alert('User Not Found Please Signup First')</script>";
            echo "<script>window.location='signup.php'</script>";
        }
    }
    else
    {
        //echo "<script>alert('Username And Password Not Entered')</script>";
        echo "<script>window.location='home.php'</script>";
    }
    
?>