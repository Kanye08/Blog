<?php
include("function/sessions.php");
include("dbconnect.php");
include("function/redirect.php");

confirmLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php include "header.php" ?>
    <div class="col-sm-2">
        <?php
        include "nav.php";
        $current_page = 'dashboard';
        ?>
    </div>
    <div class="col-sm-10">

        <?php echo errorMessage(); ?>
        <?php echo successMessage(); ?>


        <h1>ADMIN DASHBOARD</h1>
        <br>
        <table class="table table-hover table-bordered striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Images</th>
                    <th>Post</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $getPost = "select * from post";
                    $queryPost = mysqli_query($con, $getPost);
                    $sn = 0;
                    while ($datarow = mysqli_fetch_array($queryPost)) {
                        $id = $datarow['id'];
                        $img = $datarow['image'];
                        $title = $datarow['title'];
                        $date = $datarow['datetime'];
                        $category = $datarow['category'];
                        $admin = $datarow['author'];
                        $post = $datarow['post'];
                        $sn++;
                    ?>
                        <td><?php echo $sn ?></td>
                        <td>
                            <?php
                            if (strlen($date) > 15) {
                                echo substr($date, 0, 15) . "...";
                            }
                            ?>
                        </td>
                        <td><?php echo $title ?></td>
                        <td><?php echo $admin ?></td>
                        <td><?php echo $category ?></td>
                        <td><img src="images/<?php echo $img ?>" style="width:200px; max-height:20vh; object-fit:cover;">
                        </td>

                        <td>
                            <?php
                            if (strlen($post) > 5) {
                                echo substr($post, 0, 5) . "...";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="editpost.php?edit=<?php echo $id; ?>" class="btn btn-warning">Edit</a>
                            <a href="deletepost.php?delete=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                        </td>


                </tr>
            <?php } ?>
            </tbody>

        </table>

    </div>
    <?php
    include("footer.php");
    ?>
</body>


</html>