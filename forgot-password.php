<?php
  session_start();
  //Import PHPMailer classes into the global namespace
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  use Medoo\Medoo;
  include './inc/Medoo.php';

  if (isset($_GET['submit']))
  {
      //echo "Button Clicked";
      $email = $_GET['email'];
      //echo "<script>alert('$email')</script>";

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
          'email',
          [
              'email' => $email
          ]
      );

      if($userData)
      {
          //echo "<script>alert('User Found')</script>";

          //Import PHPMailer classes into the global namespace
          require_once 'vendor/autoload.php';
          
          $min = 1000;
          $max = 9999;
          $randomNumber = rand($min,$max);

          $_SESSION['email'] = $email;
          $_SESSION['randno'] = $randomNumber;
          
          $mail = new PHPMailer(true);
          $mail->isSMTP();
          $mail->SMTPAuth = true;
          //to view proper logging details for success and error messages
          // $mail->SMTPDebug = 1;
          $mail->Host = 'smtp.gmail.com'; //gmail SMTP server
          $mail->Username = 'karodpatichinmay12@gmail.com'; //email
          $mail->Password = 'hnunxrihozrtcgkf'; //16 character obtained from app password created
          $mail->Port = 465; //SMTP port
          $mail->SMTPSecure = "ssl";

          //sender information
          $mail->setFrom('karodpatichinmay12@gmail.com', 'Expense Tracker');

          //receiver address and name
          $mail->addAddress($email, 'user');

          // Add cc or bcc
          //$mail->addCC('aniketpatil6448@gmail.com');
          // $mail->addBCC('user@mail.com');
          //$mail->addAttachment(_DIR_ . '/download.png');
          // $mail->addAttachment(_DIR_ . '/exampleattachment2.jpg');

          $mail->isHTML(true);
          
          $mail->Subject = "Reset Password";
          $mail->Body ='Your 4 Digit Code is = '.$randomNumber;

          // Send mail
          if (!$mail->send())
          {
              echo 'Email not sent an error was encountered: ' . $mail->ErrorInfo;
              echo "<script> alert('Something Went Wrong'); window.location='index.php'; </script>";
          } 
          else 
          {
              echo "<script>alert('Please Check Out Your Email!');</script>";
              echo "<script>window.location='forgot-password-save.php'</script>";
          }

          $mail->smtpClose();
      }
      else
      {
          echo "<script>alert('User Not Found')</script>";
      }
  }
?>


<!DOCTYPE html>
<html
  lang="en"
  data-layout="vertical"
  data-topbar="light"
  data-sidebar="dark"
  data-sidebar-size="lg"
  data-sidebar-image="none"
>
  <!-- Mirrored from themesbrand.com/velzon/html/default/auth-pass-reset-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Jul 2022 06:35:53 GMT -->
  <head>
    <meta charset="utf-8" />
    <title>Reset Password | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      content="Premium Multipurpose Admin & Dashboard Template"
      name="description"
    />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link
      href="assets/css/bootstrap.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <div class="auth-page-wrapper pt-5">
      <!-- auth page bg -->
      <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            version="1.1"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 0 1440 120"
          >
            <path
              d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"
            ></path>
          </svg>
        </div>
      </div>

      <!-- auth page content -->
      <div class="auth-page-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-center mt-sm-5 mb-4 text-white-50">
                <div>
                  <a href="index.html" class="d-inline-block auth-logo">
                    <img
                      src="assets/images/softanic.png"
                      alt="Image Not Found"
                      height="100" width="100"
                    />
                  </a>
                </div>
                <p class="mt-3 fs-15 fw-medium">
                Expenses Tracker
                </p>
              </div>
            </div>
          </div>
          <!-- end row -->

          <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
              <div class="card mt-4">
                <div class="card-body p-4">
                  <div class="text-center mt-2">
                    <h5 class="text-primary">Forgot Password?</h5>
                    <p class="text-muted">Reset password with velzon</p>

                    <lord-icon
                      src="https://cdn.lordicon.com/rhvddzym.json"
                      trigger="loop"
                      colors="primary:#0ab39c"
                      class="avatar-xl"
                    ></lord-icon>
                  </div>

                  <div
                    class="alert alert-borderless alert-warning text-center mb-2 mx-2"
                    role="alert"
                  >
                    Enter your email and instructions will be sent to you!
                  </div>
                  <div class="p-2">
                    <form method="get" action=''>
                      <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input
                          type="email"
                          class="form-control"
                          name="email"
                          id="email"
                          placeholder="Enter Email"
                        />
                      </div>

                      <div class="text-center mt-4">
                        <button class="btn btn-success w-100" name="submit" type="submit">
                          Submit
                        </button>
                      </div>
                    </form>
                    <!-- end form -->
                  </div>
                </div>
                <!-- end card body -->
              </div>
              <!-- end card -->

              <div class="mt-4 text-center">
                <p class="mb-0">
                  Wait, I remember my password...
                  <a
                    href="index.php"
                    class="fw-semibold text-primary text-decoration-underline"
                  >
                    Click here
                  </a>
                </p>
              </div>
            </div>
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </div>
      <!-- end auth page content -->

      <!-- footer -->
      <footer class="footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-center">
                <p class="mb-0 text-muted">
                  &copy;
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  Softanic Solutions Pvt. Ltd. Jalgaon
                  <i class="mdi mdi-heart text-danger"></i>
                </p>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="assets/libs/particles.js/particles.js"></script>

    <!-- particles app js -->
    <script src="assets/js/pages/particles.app.js"></script>
  </body>

  <!-- Mirrored from themesbrand.com/velzon/html/default/auth-pass-reset-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Jul 2022 06:35:53 GMT -->
</html>
