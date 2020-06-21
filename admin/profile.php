<?php

include "includes/header.php";

if(isset($_SESSION['user_id'])){
    $userID = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id = $userID";
    $viewUser = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($viewUser)){
        $userID = $row['user_id'];
        $userName = $row['user_name'];
        $firstName = $row['user_firstname'];
        $lastName = $row['user_lastname'];
        $userEmail = $row['user_email'];
        $userPassword = $row['user_password'];
        $password = $_SESSION['real_password'];
    }
}

if(isset($_POST['updateProfile'])){
    $userName = $_POST['user_name'];
    $firstName = $_POST['user_firstname'];
    $lastName = $_POST['user_lastname'];
    $userEmail = $_POST['user_email'];
    $salt = "$2y#26";
    $userPassword = crypt($_POST['user_password'], $salt);

    // $userImage = $_FILES['image']['name'];
    // $userImageTemp = $_FILES['image']['tmp_name'];

    // move_uploaded_file($postImageTemp, "../images/$userImage");

    // if(empty($userImage)){
    //     $query = "SELECT * FROM users WHERE user_id = $userID";

    //     $selectImage = mysqli_query($connection, $query);

    //     while($row = mysqli_fetch_array($selectImage)){
    //         $userImage = $row['user_image'];
    //     }
    // }

    $query = "UPDATE users SET ";
    $query.= "user_name = '{$userName}', ";
    $query.= "user_firstname = '{$firstName}', ";
    $query.= "user_lastname = '{$lastName}', ";
    $query.= "user_email = '{$userEmail}', ";
    $query.= "user_password = '{$userPassword}' ";
    $query.= "WHERE user_id = {$userID}";


    $updateUser = mysqli_query($connection, $query);

    if(!$updateUser){
        die('Query Failed ' . mysqli_error($connection));
    }
    else{
        header('Location: profile.php');
    }
}
?>


    <div id="wrapper">

        <!-- Navigation -->
        <?php

            include "includes/navigation.php";

        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                                <?php

                                $userID = $_SESSION['user_id'];

                                $query = "SELECT * FROM users WHERE user_id = $userID";
                                $displayUser = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($displayUser)){
                                    $userRole = $row['user_role'];
                                    $userName = $row['user_name'];
                                    echo "Welcome {$userRole}, ";
                                    echo "<small>{$userName}</small>";
                                }
                                $_SESSION['user_name'] = $userName;
                                $_SESSION['user_role'] = $userRole;
                                ?>
                            </h1>
                        <form action="" method="post" class="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Edit Username</label>
                                <input type="text" class="form-control" name="user_name" value="<?php echo $userName; ?>">
                            </div>
                            <div class="form-group">
                                <label for="author">Edit Firstname</label>
                                <input type="text" class="form-control" name="user_firstname" value="<?php echo $firstName; ?>">
                            </div>
                            <div class="form-group">
                                <label for="status">Edit Lastname</label>
                                <input type="text" class="form-control" name="user_lastname" value="<?php echo $lastName; ?>">
                            </div>
                            <div class="form-group">
                                <label for="tags">Edit Email</label>
                                <input type="text" class="form-control" name="user_email" value="<?php echo $userEmail; ?>">
                            </div>
                            <div class="form-group">
                                <label for="content">Edit Password</label>
                                <input type="text" class="form-control" name="user_password" value="<?php echo $password; ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="updateProfile" value="Update Profile" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>