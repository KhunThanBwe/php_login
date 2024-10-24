<?php
    session_start();
    require 'db_connect.php';

    if(isset($_POST['login_btn'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);


        $result = mysqli_query($connect, "SELECT * FROM registration WHERE email='$email' AND password='$password'");
        $user_count = mysqli_num_rows($result); // 1

        if($user_count === 1) {
            $user_array = mysqli_fetch_assoc($result);
            $_SESSION['user_array'] = $user_array;
            if($user_array['status'] == 1){
                header('location:dashboard.php');
            }else {
                header('location:user_dashboard.php');
            }
        }else {
            echo "<script>alert('Login Failed!');
                window.location = 'register.php';
                </script>";
        }
    }
?>
<?php require './parsal/header.php'; ?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="container">
            <h1>Login Form</h1>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Enter Password">
                </div>
                <div>
                    <button type="submit" name="login_btn" class="btn btn-primary btn-sm mt-2">Login</button>
                    <span class="p-2">If you don't account. <i><a href="register.php">Register here</a></i></span>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php require './parsal/footer.php'; ?>