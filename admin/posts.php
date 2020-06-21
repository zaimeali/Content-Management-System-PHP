<?php

include "includes/header.php";

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
                        <?php
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }
                            else{
                                $source = '';
                            }

                            switch($source){
                                case "add_post":
                                include "includes/add_post.php";
                                break;

                                case "edit_post":
                                include "includes/edit_post.php";
                                break;

                                default:
                                include "includes/view_all_posts.php";
                                break;
                            }
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>