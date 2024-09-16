<?php 
session_start();

// Set up database connection
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "data_saw";
$koneksi    = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);

// Initialize variables
$err        = "";
$username   = "";

// Check if session is set
if (isset($_SESSION['session_username'])) {
    // Redirect based on role
    if ($_SESSION['role'] === 'admin') {
        header("location:home.php");
    } else {
        header("location:user_account.php");
    }
    exit();
}

// Handle login process
if (isset($_POST['login'])) {
    $username   = $_POST['username'];
    $password   = $_POST['password'];

    if ($username == '' || $password == '') {
        $err .= "<li>Enter username and password.</li>";
    } else {
        $sql1 = "SELECT * FROM akun WHERE username = '$username'";
        $q1   = mysqli_query($koneksi, $sql1);
        $r1   = mysqli_fetch_array($q1);

        if (!$r1) {
            $err .= "<li>Username <b>$username</b> not found.</li>";
        } elseif ($r1['password'] != md5($password)) {
            $err .= "<li>Password incorrect.</li>";
        } else {
            // Store session variables
            $_SESSION['session_username'] = $username;
            $_SESSION['session_password'] = $r1['password']; // Already hashed in DB
            $_SESSION['role'] = $r1['role'];

            // Redirect based on role
            if ($_SESSION['role'] === 'admin') {
                header("location:home.php");
            } else {
                header("location:home.php");
            }
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="shortcut icon" href="img/logo.jpg">
    <style>
    body.login {
         background-image: url("img/gambia2.jpeg");
         background-size: cover;}
    </style>
</head>
<body class="login">
<div class="loader"></div>
<div class="container content my-4">    
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Login</div>
            </div>      
            <div style="padding-top:30px" class="panel-body">
                <?php if($err){ ?>
                    <div id="login-alert" class="alert alert-danger col-sm-12">
                        <ul><?php echo $err ?></ul>
                    </div>
                <?php } ?>                
                <form id="loginform" class="form-horizontal" action="" method="post" role="form">       
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value="<?php echo $username ?>" placeholder="username">                                        
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <input type="submit" name="login" class="btn btn-primary" value="Login"/>
                        </div>
                    </div>
                </form>    
            </div>                     
        </div>  
    </div>
</div>
</body>
</html>
