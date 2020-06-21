<?php

if(isset($_GET['p_id'])){
    $postID = $_GET['p_id'];

    $query = "SELECT * FROM posts WHERE post_id = $postID";
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
        $postContent = $row['post_content'];
    }
}

if(isset($_POST['updatePost'])){
    $postCategory = $_POST['category'];
    $postTitle = $_POST['title'];
    $postAuthor = $_POST['author'];
    $postDate = date('d-m-y');

    $postImage = $_FILES['image']['name'];
    $postImageTemp = $_FILES['image']['tmp_name'];

    $postTags = $_POST['tags'];
    $postCommentCount = 0;
    $postStatus = $_POST['status'];
    $postContent = $_POST['content'];

    move_uploaded_file($postImageTemp, "../images/$postImage");

    if(empty($postImage)){
        $query = "SELECT * FROM posts WHERE post_id = $postID";

        $selectImage = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($selectImage)){
            $postImage = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query.= "post_title = '{$postTitle}', ";
    $query.= "post_category_id = '{$postCategory}', ";
    $query.= "post_date = now(), ";
    $query.= "post_author = '{$postAuthor}', ";
    $query.= "post_status = '{$postStatus}', ";
    $query.= "post_tags = '{$postTags}', ";
    $query.= "post_content = '{$postContent}', ";
    $query.= "post_image = '{$postImage}' ";
    $query.= "WHERE post_id = {$postID}";


    $updatePost = mysqli_query($connection, $query);

    if(!$updatePost){
        die('Query Failed ' . mysqli_error($connection));
    }
    else{
        header('Location: posts.php');
    }
}
?>



<form action="" method="post" class="form" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Edit Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $postTitle; ?>">
    </div>
    <div class="form-group">
        <label for="category">Edit Post Category</label>
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
        <label for="author">Edit Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php echo $postAuthor; ?>">
    </div>
    <div class="form-group">
        <label for="status">Edit Post Status</label>
        <select name="status" id="status" class="form-control">
                <option value="<?php echo $postStatus; ?>"><?php echo $postStatus; ?></option>
                <?php
                    if($postStatus == "Draft"){
                        ?>
                <option value="Published">Published</option>
                        <?php
                    }
                    else{
                        ?>
                <option value="Draft">Draft</option>
                        <?php
                    }
                ?>
        </select>
    </div>
    <div class="form-group">
        <br>
        <label for="image">Edit Post Image</label><br>
        <img width="500" src="../images/<?php echo $postImage; ?>">
        <input type="file" name="image">
        <br>
    </div>
    <div class="form-group">
        <label for="tags">Edit Post Tags</label>
        <input type="text" class="form-control" name="tags" value="<?php echo $postTags; ?>">
    </div>
    <div class="form-group">
        <label for="content">Edit Post Content</label>
        <textarea type="text" class="form-control" name="content" cols="30" rows="10" resize='none'><?php echo $postContent; ?>
        </textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="updatePost" value="Update Post" class="btn btn-primary">
    </div>
</form>