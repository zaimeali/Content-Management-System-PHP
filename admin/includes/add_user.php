<?php

if(isset($_POST['user'])){
    $userName = $_POST['user_name'];
    $firstName = $_POST['user_firstname'];
    $lastName = $_POST['user_lastname'];
    $userEmail = $_POST['user_email'];
    $userPassword = $_POST['user_password'];

    // $userImage = $_FILES['image']['name'];
    // $userImageTemp = $_FILES['image']['tmp_name'];

    $userRole = $_POST['user_role'];

    // move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "INSERT INTO users(user_name, user_firstname, user_lastname, user_email, 
    user_password, user_role) ";
    $query.= "VALUES('$userName', '$firstName', '$lastName', '$userEmail', '$userPassword', 
    '$userRole')";

    $insert = mysqli_query($connection, $query);

    if(!$insert){
        die("Query Failed ". mysqli_error($connection));
    }

    echo "<strong>User Created</strong>: " . " <a href='users.php'>View User</a>";
}
?>
<form action="" method="post" class="form" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">User Name</label>
        <input type="text" class="form-control" name="user_name">
    </div>
    <div class="form-group">
        <label for="title">User First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="author">User Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="status">User Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="tags">User Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    <!-- <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" name="image">
    </div> -->
    <div class="form-group">
        <label for="content">User Role</label>
        <br>
        <select name="user_role" id="" class="form-control">
            <option value='' disabled>Select a Role</option>
            <option value='Admin'>Admin</option>
            <option value='Moderator'>Moderator</option>
            <option value='Subscriber'>Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="user" value="Add User" class="btn btn-primary">
    </div>
</form>