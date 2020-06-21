<div class="col-md-4">
            
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Login Well -->
                <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input id="username" name="username" type="text" class="form-control" placeholder="Enter username..">
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="Enter password..">
                        </div>
                        <button class="btn btn-primary" name="login" type="submit">Login</button>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                <?php

                    $query = "SELECT * FROM categories";
                    $category = mysqli_query($connection, $query);
                ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">

                            <?php
                                while($row = mysqli_fetch_assoc($category)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    
                                    echo "<li><a href='category.php?c_id=$cat_id'>{$cat_title}</a></li>";
                                }
                            ?>

                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php
                    include "widget.php";
                ?>
            </div>