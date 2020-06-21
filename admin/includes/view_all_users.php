<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Image</th>
                                    <th>Role</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $query = "SELECT * FROM users";
                                $viewUser = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($viewUser)){
                                    $userID = $row['user_id'];
                                    $userName = $row['user_name'];
                                    $userFirstName = $row['user_firstname'];
                                    $userLastName = $row['user_lastname'];
                                    $userEmail = $row['user_email'];
                                    $userPassword = $row['user_password'];
                                    $userImage = $row['user_image'];
                                    $userRole = $row['user_role'];
                                    echo "<tr>";
                                        echo "<td>{$userID}</td>";
                                        echo "<td>{$userName}</td>";
                                        echo "<td>{$userFirstName}</td>";
                                        echo "<td>{$userLastName}</td>";
                                        echo "<td>{$userEmail}</td>";
                                        echo "<td>{$userPassword}</td>";
                                        echo "<td><img width='150' src='../images/{$userImage}'></td>";
                                        echo "<td>{$userRole}</td>";
                                        echo "<td><a href='users.php?source=edit_user&u_id=$userID'>Edit</a></td>";
                                        echo "<td><a onClick = \"javascript: return confirm('Are you sure you want to delete this user?'); \" href='users.php?delete=$userID'>Delete</a></td>";
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                        </table>

                        <?php

                            if(isset($_GET['delete'])){
                                $deleteUserID = $_GET['delete'];

                                $query = "DELETE FROM users WHERE user_id = {$deleteUserID}";
                                $deleteQuery = mysqli_query($connection, $query);

                                header('Location: users.php');
                            }

                        ?>