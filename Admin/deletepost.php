<?php
include("dbconnect.php");
include("function/sessions.php");
include("function/redirect.php");

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $category = $_POST['cate'];
    // for uploading images
    $Image = $_FILES['image']['name'];
    $targetFolder = "images/" . basename($_FILES['image']['name']);
    $time = gmdate("Y/M/D H:m:s");
    $Admin = "Kanye";
    $Post = $_POST['post'];


    $deleteURL = $_GET['delete'];

    $deleteQuery = "DELETE FROM post where id = '$deleteURL'";
    $execute = mysqli_query($con, $deleteQuery);
    move_uploaded_file($_FILES['image']['tmp_name'], $targetFolder);
    if ($execute) {
        $_SESSION['successMessage'] = "Deleted Successfully!";
        redirectTo("dashboard.php");
    } else {
        $_SESSION['errorMessage'] = " Delete Post Failed!";
        redirectTo("editpost.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post</title>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="col-sm-2">
        <?php
        include("nav.php");
        ?>
    </div>
    <div class="col-sm-10">
        <h1>DELETE POST</h1>
        <?php echo errorMessage(); ?>
        <?php echo successMessage(); ?>


        <form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
            <?php
            global $con;
            $id = $_GET['delete'];
            $queryPostForUpdate = "SELECT * from post WHERE id = '$id'";
            // id = ".$_GET['id']; is thesame as id='$id';
            $setPostUpdate = mysqli_query($con, $queryPostForUpdate);
            while ($row = mysqli_fetch_array($setPostUpdate)) {
                $titleUpdate = $row['title'];
                $categoryUpdate = $row['category'];
                $ImageUpdate = $row['image'];
                $AdminUpdate = $row['author'];
                $PostUpdate = $row['post'];
            }
            ?>

            <div class="form-group">
                <span style="color:black"> Previous Title: <?php echo $titleUpdate ?></span><br>
                <input disabled type="text" class="form-control" name="title" value="">
            </div>

            <br>

            <div class="form-group">
                <span style="color:black"> Previous Category:</span><br>
                <input disabled type="text" class="form-control" name="cate" list="cate"
                    value="<?php echo $categoryUpdate ?>">
                <datalist id="cate">
                    <?php
                    $fetchQuery = "select * from creators order by datetime desc";
                    $executeFetch = mysqli_query($con, $fetchQuery);

                    while ($rowData = mysqli_fetch_array($executeFetch)) {
                        $id = $rowData['id'];
                        $category = $rowData['category'];




                    ?>
                    <option value="<?php echo $category ?>"></option>
                    <?php } ?>
                </datalist>
            </div>
            <br><br>

            <div class="form-group">
                <span style="color:black">Previous Image: <img src="images/<?php echo $ImageUpdate ?>" width="100px"
                        height="70px" alt=""></span> <br>
                <input disabled type="file" class="form-control" name="image">
            </div>
            <br><br>

            <div class="form-group">
                <textarea name="post" value="" id="input" class="form-control" rows="3" value=""
                    required="required"><?php echo $PostUpdate ?></textarea>
            </div>

            <button name="submit" class="btn btn-danger btn-block">Delete Post</button>


        </form>
        <br><br>

    </div>


    <?php include("footer.php") ?>

</body>

</html>