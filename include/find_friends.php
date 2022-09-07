<!DOCTYPE html>
<?php 
session_start();
include('find_friends_function.php');

if(!isset($_SESSION['user_email'])){
    header("location:signin.php");
}

else{
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMchat _ search friends</title>
     <!-- bootstrap cdn -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<!-- custom -->
<link rel="stylesheet" href="../css/find_people.css">

</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand nav-link" href="#">
            <?php 
                $user=$_SESSION['user_email'];
                $get_user="SELECT * from users where user_email='$user'";
                $run_user=mysqli_query($con,$get_user);
                $row=mysqli_fetch_array($run_user);

                $user_name=$row['user_name'];
                echo "<a class='nav-link text-light' href='../home.php?user_name=$user_name'>SM Chat</a>";
            ?>
        </a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../account_setting.php">Setting</a>
            </li>
        </ul>
        </div>

    </nav><br>
    <div class="row">
        <div class="col-sm-4">

        </div>
        <div class="col-sm-4">
            <form action="" class="search_form">
                <input type="text" name="search_query" placeholder="Search friends .." autocomplete="off" required>
                <button type="submit" name="search_btn" class="btn">
                    Search
                </button>
            </form>
        </div>
        <div class="col-sm-4">

        </div>
    </div><br><br>
    <?php search_user(); ?>
</body>
</html>
<?php }; ?>