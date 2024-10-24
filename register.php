<?php
    require 'db_connect.php';

    $usernameError = '';
    $emailError = '';
    $passwordError = '';
    $confirm_passwordError = '';
    

    if(isset($_POST['register_btn'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        //Invalid Values
        if(empty($username)) {
            $usernameError = 'Username field is required';
        }
        if(empty($email)) {
            $emailError = 'Email field is required';
        }
        if(empty($password)) {
            $passwordError = 'Password field is required';
        }
        if(empty($confirm_password)) {
            $confirm_passwordError = 'Confirm_password field is required';
        }
        if($password!=$confirm_password) {
            $match = "Password or Confirm_password does not match!";
        }
        if(strlen($password) >= 8) {
            $countpass = "";
        } else {
            $countpass = "Password must be at least 8 characters long";
        }

        if(!empty($username) && !empty($email) && !empty($password) && !empty($confirm_password) && ($password==$confirm_password) && (strlen($password) >= 8)) {
            //validated already account
            $select = mysqli_query($connect, "SELECT * FROM registration WHERE username='$username' AND email='$email'");

            if(mysqli_num_rows($select) > 0 ) {
                echo "<script>alert('Account already exist!');
                window.location = 'login.php';
                </script>";
            }else {
                $encrpPass = md5($_POST['password']);
                
                //Insert user in Database
                $insert = mysqli_query($connect, "INSERT INTO registration(username, email, password, status) VALUES ('$username', '$email', '$encrpPass', 0)");

                if($insert) {
                    echo "<script>alert('Registration Successfully!');
                    window.location = 'login.php';
                    </script>";
                }else {
                    echo "<script>alert('Something Error!');
                    window.location = 'register.php';
                    </script>";
                }
            }
        }
    }
    
?>
<?php require './parsal/header.php'; ?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="container">
            <h1>Register Form</h1>
            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" placeholder="Enter Username">
                    <i class="text-danger"><?php echo $usernameError; ?></i>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="eami;" name="email" placeholder="Enter Email">
                    <i class="text-danger"><?php echo $emailError; ?></i>
                    </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Enter Password">
                    <i class="text-danger"><?php echo $passwordError; ?></i> 
                    <i class="text-danger"><?php echo $countpass; ?></i>
                    </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm_password</label>
                    <input class="form-control" type="password" name="confirm_password" placeholder="Enter Confirm_password">
                    <i class="text-danger"><?php echo $confirm_passwordError; ?></i> 
                    <i class="text-danger"><?php echo $match; ?></i>
                    </div>
                <div>
                    <button type="submit" name="register_btn" class="btn btn-primary btn-sm mt-2">Register</button>
                    <span class="p-3">You have alerady account. <i><a href="login.php">Login here</a></i></span>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php require './parsal/footer.php'; ?>