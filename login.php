<?php include_once '../task_manager/helper/path_helper.php';?>
<?php include_once '../task_manager/helper/db_helper.php';?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $login_error = "";

    if ($email == "" && $pass == "")
    {
        $login_error = "Please Enter Email and Password";
    }
    else
    {
        $query = "SELECT * FROM users where email = '$email' AND password = '$pass'";

        $result = mysqli_query($con, $query);
        $result_login = mysqli_num_rows($result);

        if ($result_login == 1)
        {
            header('location:home.php');
        }
        else
        {
            $login_error = "Your are not Registered!";
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
                                <h2 class="register-heading">Task For Employee</h2>
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
                                        <input type="submit" class="btnRegister"  value="Log In"/>
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

