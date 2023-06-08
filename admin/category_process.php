<?php
include_once('include/config.php');
if (isset($_POST['submit']) && $_POST['submit'] == "add") {
    extract($_POST);
    $filename = $_FILES['categoryimage']['name'];
    $newname = time() . '-' . $filename;
    $path = '../images/category/' . $newname;
    if (move_uploaded_file($_FILES['categoryimage']['tmp_name'], $path)) {
        $catqry = "INSERT INTO category (categoryname,categoryimage) VALUES ('" . $categoryname . "','" . $newname . "')";
        mysqli_query($conn, $catqry);
        header("location:category.php");
    }
} elseif ($_REQUEST["val"] == 'del') {
    extract($_REQUEST);
    $newpath = "../images/category/" . $path;
    echo $newpath;
    unlink($newpath);
    $qry = "DELETE FROM category WHERE id='" . $id . "'";
    $res = mysqli_query($conn, $qry);
    header("location:category.php");
} elseif (isset($_POST['submit']) && $_POST['submit'] == "edit") {

    if ($_FILES['categoryimage']['name'] == NULL) {
        extract($_POST);
        $qry = "UPDATE category SET categoryname='" . $categoryname . "' WHERE id='" . $id . "'";
        $res = mysqli_query($conn, $qry);
        header("location:category.php");
    } else {
        extract($_POST);
        extract($_FILES);
        print_r($_POST);
        $cquery = "SELECT * FROM category WHERE id='" . $id . "'";
        $cres = mysqli_query($conn, $cquery);
        $drow = mysqli_fetch_assoc($cres);
        $dpath = "../images/category/" . $drow['categoryimage'];
        unlink($dpath);
        $filename = $_FILES['categoryimage']['name'];
        $newname = time() . '-' . $filename;
        $path = '../images/category/' . $newname;
        if (move_uploaded_file($_FILES['categoryimage']['tmp_name'], $path)) {
            $qry = "UPDATE category SET categoryname='" . $categoryname . "',categoryimage='" . $newname . "'";
            $res = mysqli_query($conn, $qry);
            header("location:category.php");
        }
    }
} else {
    echo "not add";
}
?>