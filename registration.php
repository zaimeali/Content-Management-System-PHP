<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php

if(isset($_POST['submit'])){
    $userName = $_POST['username'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];

    $salt = "$2y#26";
    $userPassword = crypt($userPassword, $salt);

    $userName = mysqli_real_escape_string($connection, $userName);
    $userEmail = mysqli_real_escape_string($connection, $userEmail);
    $userPassword = mysqli_real_escape_string($connection, $userPassword);

    $query = "INSERT INTO users(user_name, user_email, user_password, user_firstname, user_lastname, user_role) ";
    $query.= "VALUES('$userName', '$userEmail', '$userPassword', '$firstName', '$lastName', 'Subscriber' )";

    $registerUser = mysqli_query($connection, $query);

    $message = "You are Registered";
    
    if(!$registerUser){
        die("QUERY FAILED " . mysqli_error($connection));
        $message = "You are not Registered";
    }
}
else{
    $message = "";
}

?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="sr-only">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Lastname" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
