<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Comment on Post</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Comment Content</th>
                                    <th>Comment Status</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>UnApprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $query = "SELECT * FROM comments";
                                $viewComment = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($viewComment)){
                                    $comID = $row['comment_id'];
                                    $comPostID = $row['comment_post_id'];
                                    $comUser = $row['comment_author'];
                                    $comEmail = $row['comment_email'];
                                    $comContent = $row['comment_content'];
                                    $comStatus = $row['comment_status'];
                                    $comDate = $row['comment_date'];
                                    echo "<tr>";
                                        echo "<td>{$comID}</td>";

                                        $query = "SELECT * FROM posts WHERE post_id = $comPostID";
                                        $viewPostTitle = mysqli_query($connection, $query);
                                        while($row1 = mysqli_fetch_assoc($viewPostTitle)){
                                            $comPostTitle = $row1['post_title'];
                                        }
                                        
                                        echo "<td><a href='../post.php?p_id=$comPostID'>{$comPostTitle}</a></td>";
                                        
                                        echo "<td>{$comUser}</td>";
                                        
                                        // $query = "SELECT * FROM categories WHERE cat_id = $postCategoryID";
                                        // $catDisplay = mysqli_query($connection, $query);
                                        // while($row = mysqli_fetch_assoc($catDisplay)){
                                        //     $catTitle = $row['cat_title'];
                                        //     echo "<td>{$catTitle}</td>";
                                        // }

                                        echo "<td>{$comEmail}</td>";
                                        echo "<td>{$comContent}</td>";
                                        echo "<td>{$comStatus}</td>";
                                        echo "<td>{$comDate}</td>";
                                        echo "<td><a href='comments.php?approve=$comID'>Approve</a></td>";
                                        echo "<td><a href='comments.php?unapprove=$comID'>Unapprove</a></td>";
                                        echo "<td><a onClick = \"javascript: return confirm('Are you sure you want to delete this comment?'); \" href='comments.php?delete=$comID'>Delete</a></td>";
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                        </table>

                        <?php

                            if(isset($_GET['unapprove'])){
                                $unapproveCommentID = $_GET['unapprove'];

                                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$unapproveCommentID}";
                                $unapproveComment = mysqli_query($connection, $query);

                                header('Location: comments.php');
                            }

                            if(isset($_GET['approve'])){
                                $approveCommentID = $_GET['approve'];

                                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$approveCommentID}";
                                $approveComment = mysqli_query($connection, $query);

                                header('Location: comments.php');
                            }

                            if(isset($_GET['delete'])){
                                $deleteCommentID = $_GET['delete'];

                                $query = "DELETE FROM comments WHERE comment_id = {$deleteCommentID}";
                                $deleteComment = mysqli_query($connection, $query);

                                header('Location: comments.php');
                            }

                        ?>