<?php

if(isset($_POST['add'])){
    $postCategory = $_POST['category'];
    $postTitle = $_POST['title'];
    $postAuthor = $_POST['author'];
    $postDate = date('d-m-y');

    $postImage = $_FILES['image']['name'];
    $postImageTemp = $_FILES['image']['tmp_name'];

    $postTags = $_POST['tags'];
    // $postCommentCount = 0;
    $postStatus = $_POST['status'];
    $postContent = $_POST['content'];

    move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, 
    post_image, post_content, post_tags, post_status)";
    $query.= "VALUES('$postCategory', '$postTitle', '$postAuthor', now(), '$postImage', 
    '$postContent', '$postTags', '$postStatus')";

    $insert = mysqli_query($connection, $query);

    if(!$insert){
        die("Query Failed ". mysqli_error($connection));
    }
}
?>



<form action="" method="post" class="form" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="category">Post Category</label>
        <br>
        <select name="category" id="" class="form-control">
            <?php
                $query = "SELECT * FROM categories";
                $categories_id = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($categories_id)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='$cat_id'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" class="form-control" name="status">
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags">
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea type="text" class="form-control" name="content" cols="30" rows="10" resize='none'></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="add" value="Add Post" class="btn btn-primary">
    </div>
</form>