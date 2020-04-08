<?php
session_start();
?>
<?php include_once '../wasilah-e-jannat/helper/path_helper.php';?>
<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>

<?php
if (isset($_POST['btn_login']))
{

    $email = $_POST['email'];
    $pass = $_POST['password'];
    $login_error = "";

    if ($email == "" && $pass == "")
    {
        $login_error = "Please Enter Email & Password";
    }
    else
    {
        $login_query = "SELECT * FROM fund_raiser where email = '$email' AND password = '$pass'";

        $result_login = mysqli_query($con, $login_query);
        $result = mysqli_num_rows($result_login);

        if ($result == 1)
        {
            $user_result = mysqli_fetch_assoc($result_login);
            if ($user_result['user_approval'] == 1)
            {
                $f_name = $user_result['first_name'];
                $l_name = $user_result['last_name'];
                $_SESSION['first_name'] = $f_name;
                $_SESSION['last_name'] = $l_name;
                header('location:home.php');

            }
            else
            {
                $login_error = "Your approval is pending.!";
            }
        }
        else
        {
            $login_error = "You are not Registered!";
        }

    }

}
?>

<html>
<head>
    <title> Task Manager - Login </title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js">
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <link href="<?=APPLICATION_URL . 'css/login.css';?>" rel="stylesheet">
</head>

<body class="bg-login">
<div class="register">
<div class="container">

                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                        <p>You are 30 seconds away from earning your own money!</p>


                    </div>
                    <div class="col-md-9 register-right">

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h2 class="register-heading">Login</h2>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <div class="row register-form">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="Email *" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password *" value="" />
                                        </div>
                                        <p style="color: red;">
                                    <?php
if (isset($login_error))
{
    echo $login_error;
}?>
                                        <input type="submit" name="btn_login" class="btnRegister"  value="Log In"/>
                                    </div>

                                </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                </div>
            </div>
</body>

</html>

