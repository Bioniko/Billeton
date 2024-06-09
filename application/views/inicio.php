<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSPINIA | Login</title>
    <link href="<?php echo base_url();?>Tema/Static_Full_Version/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>Tema/Static_Full_Version/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>Tema/Static_Full_Version/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>Tema/Static_Full_Version/css/style.css" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name"><img alt="image" class="img-circle" src="<?php echo base_url();?>Tema/Static_Full_Version/img/profile_small.png" style="width: 40%;"/></h1>
            </div>
            <h3>Bienvenido</h3>
            <p>
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Login in. To see it in action.</p>
            <form class="m-t" role="form" action="<?php echo base_url();?>index.php/Inicio/Show" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" required="" name="txt_user">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="" name="txt_pass">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="<?php echo base_url();?>Tema/Static_Full_Version/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url();?>Tema/Static_Full_Version/js/bootstrap.min.js"></script>
</body>
</html>
