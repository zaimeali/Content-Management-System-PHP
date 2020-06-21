<?php

if(isset($_POST['checkboxArray'])){
    foreach($_POST['checkboxArray'] as $checkBoxID){
        $options = $_POST['options'];
        switch($options){
            case "Published":
                $query = "UPDATE posts SET post_status = '{$options}' WHERE post_id = $checkBoxID";
                $executeQuery = mysqli_query($connection, $query);
            break;

            case "Draft":
                $query = "UPDATE posts SET post_status = '{$options}' WHERE post_id = $checkBoxID";
                $executeQuery = mysqli_query($connection, $query);
            break;
            
            case "Delete":
                $query = "DELETE FROM posts WHERE post_id = $checkBoxID";
                $executeQuery = mysqli_query($connection, $query);
            break;

        }
    }
}

?>
                   <form action="" method="post">
                        <table class="table table-bordered table-hover">
                            <div id="bulkOption" class="col-xs-4">
                                <select name="options" class="form-control">
                                    <option value="">Select an Option</option>
                                    <option value="Published">Publish</option>
                                    <option value="Draft">Draft</option>
                                    <option value="Delete">Delete</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                                <a class="btn btn-primary" href="add_post.php">Add New Post</a>
                            </div>
                            <thead>
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $query = "SELECT * FROM posts";
                                $viewPost = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($viewPost)){
                                    $postID = $row['post_id'];
                                    $postCategoryID = $row['post_category_id'];
                                    $postTitle = $row['post_title'];
                                    $postAuthor = $row['post_author'];
                                    $postDate = $row['post_date'];
                                    $postImage = $row['post_image'];
                                    $postTags = $row['post_tags'];
                                    $postCommentCount = $row['post_comment_count'];
                                    $postStatus = $row['post_status'];
                                    echo "<tr>";
                                    ?>
                                        <td><input class='checkBox' type='checkbox' name='checkboxArray[]' value="<?php echo $postID; ?>"></td>;
                                    <?php
                                        echo "<td>{$postID}</td>";
                                        echo "<td>{$postAuthor}</td>";
                                        echo "<td>{$postTitle}</td>";
                                        
                                        $query = "SELECT * FROM categories WHERE cat_id = $postCategoryID";
                                        $catDisplay = mysqli_query($connection, $query);
                                        while($row = mysqli_fetch_assoc($catDisplay)){
                                            $catTitle = $row['cat_title'];
                                            echo "<td>{$catTitle}</td>";
                                        }

                                        echo "<td>{$postStatus}</td>";
                                        echo "<td><img width='150' src='../images/{$postImage}'></td>";
                                        echo "<td>{$postTags}</td>";
                                        echo "<td>{$postCommentCount}</td>";
                                        echo "<td>{$postDate}</td>";
                                        echo "<td><a href='posts.php?source=edit_post&p_id=$postID'>Edit</a></td>";
                                        echo "<td><a onClick = \"javascript: return confirm('Are you sure you want to delete this post?'); \" href='posts.php?delete=$postID'>Delete</a></td>";
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                        </table>

                        <?php

                            if(isset($_GET['delete'])){
                                $deletePostID = $_GET['delete'];

                                $query = "DELETE FROM posts WHERE post_id = {$deletePostID}";
                                $deleteQuery = mysqli_query($connection, $query);

                                header('Location: posts.php');
                            }

                        ?>
                    </form>