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

                        <?php insert_categories(); ?>  

                        <div class="col-xs-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Category Title: </label>
                                    <input class="form-control" type="text" name="cat_title" id='cat-title'>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                        <th>Delete Category</th>
                                        <th>Update Category</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php display_categories(); ?>

                                <?php delete_category(); ?>
                                
                                <tbody>
                            </table>
                        </div>

                        <!-- Update Category -->
                        <?php
                            if(isset($_GET['edit'])){
                                $cat_id = $_GET['edit'];
                                include "includes/update_category.php";
                            }
                        ?>

                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>