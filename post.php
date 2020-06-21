<!-- DATABASE -->
<?php include "includes/db.php"; ?>


<!-- HEADER -->
<?php include "includes/header.php"; ?>


<!-- NAVIGATION -->
<?php include "includes/navigation.php"; ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                    if(isset($_GET['p_id'])){
                        $postID = $_GET['p_id'];
                    }
                    $query = "SELECT * FROM posts WHERE post_id = {$postID}";

                    $posts = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($posts)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];

                ?>

                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1> 

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <hr>

                <?php
                    }

                ?>
                
                <!-- Blog Comments -->
                <?php
                    if(isset($_POST['insert_comment'])){
                        $postID = $_GET['p_id'];

                        $comUser = $_POST['comment_author'];
                        $comEmail = $_POST['comment_email'];
                        $comContent = $_POST['comment_content'];

                        $query = "INSERT INTO comments ";
                        $query.= "(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                        $query.= "VALUES ($postID, '{$comUser}', '{$comEmail}', '{$comContent}', 'unapproved', now())";

                        $insertComment = mysqli_query($connection, $query);

                        if(!$insertComment){
                            die('Query Failed ' . mysqli_error($connection));
                        }

                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                        $query.= "WHERE post_id = $postID";

                        $updateCount = mysqli_query($connection, $query);
                    }
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" class="form-control" name="comment_author" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="email" class="form-control" name="comment_email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment: </label>
                            <textarea class="form-control" rows="3" id="comment" name="comment_content" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="insert_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->


                <?php

                    $query = "SELECT * FROM comments WHERE comment_post_id = {$postID} ";
                    $query.= "AND comment_status = 'approved' ";
                    $query.= "ORDER BY comment_id DESC";

                    $showComment = mysqli_query($connection, $query);

                    if(!$showComment){
                        die('Query Failed ' . mysqli_error($connection));
                    }

                    while($row = mysqli_fetch_assoc($showComment)){
                        $comDate = $row['comment_date'];
                        $comContent = $row['comment_content'];
                        $comAuthor = $row['comment_author'];
                        ?>
                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comAuthor; ?>
                                    <small><?php echo $comDate; ?></small>
                                </h4>
                                <?php echo $comContent; ?>
                            </div>
                        </div>
                        <?php
                    }
                ?>

                <!-- Comment
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        Nested Comment 
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        End Nested Comment 
                    </div>
                </div> -->

                

                <!-- Pager
                <ul class="pager"> 
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<!-- FOOTER -->
<?php include "includes/footer.php"; ?>