
                        <div class="col-xs-6">
                        <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Category Title: </label>
                        <?php

                            if(isset($_GET['edit'])){
                                $edit_cat_id = $_GET['edit'];

                                $query = "SELECT * FROM categories WHERE cat_id = {$edit_cat_id}";
                                $categories_id = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($categories_id)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                   
                                } 
                                ?>
                                <input value="<?php if(isset($cat_title)){ echo $cat_title; } ?>" class="form-control" type="text" name="update_cat_title" id='cat-title'>
                                <?php
                            }
                        ?>

                        <?php

                            if(isset($_POST['update'])){
                                $update_cat_title = $_POST['update_cat_title'];

                                $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = '{$cat_id}'";
                                $update = mysqli_query($connection, $query);

                                if(!$update){
                                    die('Query Failed '. mysqli_error($connection));
                                }
                                else{
                                    header("Location: categories.php");
                                }
                            }

                        ?>
                           
                                    </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update" value="Update Category">
                                </div>
                            </form>
                        </div>