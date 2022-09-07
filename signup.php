<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/bg2.jpg" type="image/x-icon">
    <title>smChat - register</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custoncss -->
    <link rel="stylesheet" href="css/signup.css">

</head>
<body>
    <div class="signup-form">
        <form action="" method="post">
            <div class="form-header">
                <h2>Sign Up</h2>
                <p>Register you to chat with your friends</p>
            </div>
            <div class="form-group">
                <label for="user_name">Username</label>
                <input type="text" class="form-control" name="user_name" placeholder="Enter username" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="user_pass" placeholder="Password must be 8 letter" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="user_email" placeholder="Enter email" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="user_country">Country</label>
                <select name="user_country" class="form-control form-select" required>
                    <option disabled="">Select a Country</option>
                    <option >Pakistan</option>
                    <option >USA</option>
                    <option >India</option>
                    <option >UK</option>
                    <option >Bangladesh</option>
                </select>
            </div>
            <div class="form-group">
                <label for="user_gender">Select your gender</label>
                <select name="user_gender" class="form-control form-select" required>
                    <option disabled="">Select a Country</option>
                    <option >Male</option>
                    <option >Female</option>
                    <option >Others</option>
                </select>
            </div>
           <div class="form-group">
            <label class="checkbox-inline d-flex align-items-center"><input type="checkbox" required>I accept the<a href="#">Terms of use</a> &amp; <a href="#">Privacy Policy</a></label>
           </div>

            
            <div class="form-group  d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-block btn-lg" name="sign_up">Register</button>
            </div>
            <?php include("signup_user.php"); ?>
        </form>
        <div class="text-center small" style="color:white;">Already have an account <a href="signin.php" style="color:aqua">Sign in</a></div>
    </div>
</body>
</html>