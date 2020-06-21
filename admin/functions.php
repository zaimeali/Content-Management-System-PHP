<?php

function insert_categories(){

    global $connection;

    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This Field should not be Empty";
        }
        else{
            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";
            $insert_category = mysqli_query($connection, $query);

            if(!$insert_category){
                die('Query Failed '. mysqli_error($connection));
            }
        }
    }
}

function display_categories(){
    
    global $connection;

    $query = "SELECT * FROM categories";
    $categories = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a onClick = \"javascript: return confirm('Are you sure you want to delete this category?'); \" href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }

}

function delete_category(){
    
    global $connection;

    if(isset($_GET['delete'])){
        $delete_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$delete_cat_id}";
        $delete_id = mysqli_query($connection, $query);

        header("Location: categories.php");
    }
}

?>