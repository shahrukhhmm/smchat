<!DOCTYPE html>
<?php 
session_start();
include('include/config.php');
include("include/header.php");

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
    <title>SMchat _ Account setiings</title>
     <!-- bootstrap cdn -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<!-- custom -->
<link rel="stylesheet" href="../css">

</head>
<body>
    <div class="row">
        <div class="col-sm-2">

        </div>
        <?php
            $user = $_SESSION['user_email'];
            $get_user = "SELECT * from user where user_email='$user'";
            $run_user=mysqli_query($con,$get_user);

            $row=mysqli_fetch_array($run_user);

            $user_name= $row['user_name'];
            $user_pass=$row['user_pass'];
            $user_email=$row['user_email'];
            $user_profile=$row['user_profile'];
            $user_country=$row['user_country'];
            $user_gender=$row['user_gender'];
        ?>

        <div class="col-sm-8">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-bordered table-hover">
                    <tr align="center">
                        <td colspan="6" class="active"><h2>Change account settings</h2></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Change Username</td>
                        <td>
                            <input type="text" name="u-name" class="from-control" required value="<?php
                            echo $user_name;?>">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="upload.php" class="btn btn-default" style="text-decoration: none;font-size:15px;"><i class="fa fa-user" aria-hidden="true"></i>Change Profile</a></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold ;">Change Your Email</td>
                        <td>
                            <input type="email" name="u-email" class="from-control" required value="<?php
                            echo $user_email;?>">
                        </td>
                    </tr>
                    <tr>
                    <td style="font-weight:bold ;">Country</td>
                        <td>
                            <select name="u_country" class="from-control">
                                <option value=""><?php echo $user_country;?></option>
                                <option>Pakistan</option>
                                <option>Turkey</option>
                                <option>Suadi Arabia</option>
                                <option>Bangladesh</option>
                            </select>
                        </td>
                    </tr>

                    <td style="font-weight:bold ;">Gender</td>
                        <td>
                            <select name="u_gender" class="from-control">
                                <option value=""><?php echo $user_gender;?></option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Others</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight: bold;">Forgotten passsword</td>
                        <td>
                            <button type="button" class="btn btn-default" data-toggle="modal"target="#myModal">Forgotten Password</button>
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button class="close" type="button" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="recovery.php?id=<?php echo $user_id ?>" method="post" id="f">
                                            <strong>What is your School Best friend Name?</strong>
                                            <textarea name="content" class="form-control" cols="83" rows="4" placeholder="Someone"></textarea><br>
                                            <input type="submit" class="btn btn-default" name="sub" value="Submit" style="width: 100px; "><br><br>
                                            <pre>Answer the above question we will ask you this question if you forgot your <br>Password.</pre>
                                        </form>
                                        <?php 
                if(isset($_POST['sub'])){
                    $bfn = htmlentities($_POST['content']);

                    if($bfn == ''){
                        echo "<script>alert('Please Enter Something')</script>";
                        echo "<script>window.open('account_settings.php')</script>";
                        exit();
                    }
                    else{
                        $update = "UPDATE users set forgotten_answer ='$bfn' where user_email='$user'";
                        $run = mysqli_query($con,$update);
                        if($run){
                            echo "<script>alert('Working ...')</script>";
                        echo "<script>window.open('account_settings.php')</script>";
                        }
                        else{
                            echo "<script>alert('Error while Updating information.')</script>";
                        echo "<script>window.open('account_settings.php')</script>";
                        }
                    }
                }
            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" data-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
           
        </div>
    </div>
</body>
</html>
<?php }; ?>