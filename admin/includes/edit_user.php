<?php

if(isset($_GET['u_id'])){
    $userID = $_GET['u_id'];

    $query = "SELECT * FROM users WHERE user_id = $userID";
    $viewUser = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($viewUser)){
        $userID = $row['user_id'];
        $userName = $row['user_name'];
        $firstName = $row['user_firstname'];
        $lastName = $row['user_lastname'];
        $userEmail = $row['user_email'];
        $userRole = $row['user_role'];
        $userPassword = $row['user_password'];
    }

}

if(isset($_POST['updateUser'])){
    $userName = $_POST['user_name'];
    $firstName = $_POST['user_firstname'];
    $lastName = $_POST['user_lastname'];
    $userEmail = $_POST['user_email'];
    $userRole = $_POST['user_role'];

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
    $query.= "user_role = '{$userRole}' ";
    $query.= "WHERE user_id = {$userID}";


    $updateUser = mysqli_query($connection, $query);

    if(!$updateUser){
        die('Query Failed ' . mysqli_error($connection));
    }
    else{
        header('Location: users.php');
    }
}
?>



<form action="" method="post" class="form" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Edit Username</label>
        <input type="text" class="form-control" name="user_name" value="<?php echo $userName; ?>">
    </div>
    <div class="form-group">
        <label for="role">Edit Role</label>
        <br>
        <select name="user_role" id="role" class="form-control">
            <option value='<?php echo $userRole; ?>'><?php echo $userRole; ?></option>
            <?php
                if($userRole == "Admin"){
                    ?>
            <option value='Moderator'>Moderator</option>
            <option value='Subscriber'>Subscriber</option>
                    <?php
                }
                elseif ($userRole == "Moderator") {
                    ?>
            <option value='Admin'>Admin</option>
            <option value='Subscriber'>Subscriber</option>
                    <?php
                }
                else{
                    ?>
            <option value='Admin'>Admin</option>
            <option value='Moderator'>Moderator</option>
                    <?php
                }
            ?>
        </select>
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
        <input type="submit" name="updateUser" value="Update User" class="btn btn-primary">
    </div>
</form>