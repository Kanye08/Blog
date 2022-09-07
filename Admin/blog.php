<?php
include("dbconnect.php");
include("function/sessions.php");
include("function/redirect.php");



if (isset($_POST['submit'])) {
    $comment = $_POST['comment'];
    $name = $_POST['name'];
    $email = $_POST['email'];



    if (empty($comment) && empty($name) && empty($email)) {
        $_SESSION['errorMessage'] = "All fields are required";
        redirectTo("blog.php");
    } else if (strlen($comment) < 2) {
        $_SESSION['errorMessage'] = "Comment cannot be less than 2 characters";
        redirectTo("blog.php");
    } else {
        global $con;

        $postQuery = "SELECT * FROM post";
        $exe = mysqli_query($con, $postQuery);
        while ($fetch = mysqli_fetch_assoc($exe)) {
            $postId = $fetch['id'];
        }


        $insertQuery = "INSERT INTO comment(name,email,comment,fkey_post) VALUES ('$name','$email','$comment','$postId')";
        $execute = mysqli_query($con, $insertQuery);

        if ($execute) {
            $_SESSION['successMessage'] = "Comment Added Successfully!";
            redirectTo("blog.php");
        } else {
            $_SESSION['errorMessage'] = "Comment not added!";
            redirectTo("blog.php");
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <style>
    * {
        color: aliceblue;
    }

    html {
        display: flex;
        background-color: rgb(31, 46, 46);

    }

    body {
        background-color: rgb(31, 46, 46) !important;
        margin: 0;
    }

    .main {
        background-color: rgb(72, 106, 106);
        height: 130vh;
        width: 100%;
        margin: 5rem 1rem;
        padding: 20px;
        border: 1px solid rgb(21, 30, 30);
    }

    .sidebar {
        background-color: rgb(72, 106, 106);
        height: 40vh;
        width: 32%;
        padding: 0 3%;
        margin: 7rem 1rem;
        height: inherit;
        padding: 20px 3%;
        text-align: center;


    }



    .myimg {
        object-fit: cover;
        height: 60vh !important;
        width: 100% !important;
    }

    .baba {
        margin-top: 2rem;
    }

    .faith {
        display: flex;
        justify-content: space-around;
    }
    </style>
</head>

<body>
    <?php
    include('header.php');
    ?>

    <?php echo errorMessage(); ?>
    <?php echo successMessage(); ?>
    <div class="faith">
        <div class="baba">
            <?php
            global $con;
            if (isset($_GET['searchBtn'])) {
                $search = $_GET['search'];
                $getPost = " select * from post where datetime LIKE '%$search%' OR title LIKE '%$search%' or category LIKE '%$search%' or post LIKE '%$search%'";
            } else {
                $getPost = "select * from post";
            }
            $queryPost = mysqli_query($con, $getPost);
            while ($datarow = mysqli_fetch_array($queryPost)) {
                $id = $datarow['id'];
                $img = $datarow['image'];
                $title = $datarow['title'];
                $date = $datarow['datetime'];
                $category = $datarow['category'];
                $admin = $datarow['author'];
                $post = $datarow['post'];



            ?>
            <div class="main">
                <section>
                    <img class="img img-responsive myimg" src="images/<?php echo $img; ?>" alt="">
                    <h3 style="color:red; font-weight:bolder;"> Title:<?php echo $title; ?></h3>
                    <h4 style="color:darkorange;">Category:<?php echo $category; ?>
                        <br>
                        <span style="font-size:12px;">Date & Time: <?php echo $date; ?></span>
                    </h4>
                    <p>POST: <?php echo $post; ?></p>

                    <form action="" method="post">
                        <h4 style="color:darkorange;">YOUR TAKE ON THIS POST</h4>

                        <?php
                            $fetchComment = "select * from comment where id='$id'";
                            $queryData = mysqli_query($con, $fetchComment);
                            while ($row = mysqli_fetch_array($queryData)) {
                                $name = $row['name'];
                                $email = $row['email'];
                                $comment = $row['comment'];
                            ?>

                        <div style="display: flex; align-items:center; width:100%; margin:10px 0; background:black;">
                            <img src="./images/avatar.png" width="30px" height="30px" alt="">
                            <div>
                                <div style="margin-left: 10px;"><?php echo $name; ?></div>
                                <div style="margin-left: 10px;"><?php echo $comment; ?></div>
                            </div>
                        </div>
                        <?php } ?>




                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                            <input type="text" class="form-control" id="exampleInputAmount" name="name"
                                placeholder="Username">
                        </div>

                        <br>

                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                            <input type="text" class="form-control" id="exampleInputAmount" name="email"
                                placeholder="Email">
                        </div>

                        <br>

                        <div class="form-group">
                            <textarea name="comment" placeholder="Comment Section" class="form-control"
                                id="textareacomment" required="required" rows="3"></textarea>
                        </div>

                        <button type="submit" name="submit" class="btn btn-info btn-block">Comment</button>
                    </form>
                </section>
            </div>

            <?php } ?>
        </div>

        <div class="sidebar">
            <section>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Perferendis, saepe. Officia, doloribus? Ex dolorem eveniet atque vero, ipsum qui ducimus harum animi
                repellat ad et possimus blanditiis,
                dignissimos officiis nemo libero iure tenetur. Natus nisi officia non minus expedita, rerum
                consequuntur excepturi?
                Repudiandae excepturi nulla quae debitis quos nesciunt voluptas.
            </section>
        </div>
    </div>
</body>

</html>