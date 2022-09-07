<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <style>
    .navbar-header>a>img {
        width: 100%;
        height: inherit;
        object-fit: cover;
        margin-top: -1.5rem;
    }

    .lines {
        border-width: 3px 0;
        border-color: teal;
        border-style: solid;

    }

    .navbar {
        margin: 0;
    }

    .user {
        width: 600px;
        position: relative;
        top: 10px;
    }
    </style>
</head>

<body>


    <nav class="navbar navbar-inverse lines" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="blog.php"><img src="./images/Blogger-Logo.png" alt=""></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="dashboard.php">Dashboard</a></li>
                <li><a href="#">About</a></li>
                <li>
                    <span class="user">
                        <?php echo errorUser();
                        echo successUser();
                        ?>
                    </span>
                </li>
            </ul>
            <form class="navbar-form navbar-right" role="search">

                <div class="input-group">
                    <input type="text" name="search" class="form-control" id="exampleInputAmount" placeholder="Search"
                        style="width:70%">
                    <button name="searchBtn" class="input-group-addon"><span style="height:20px"
                            class="glyphicon glyphicon-search"></span></button>
                </div>

            </form>

        </div><!-- /.navbar-collapse -->
    </nav>


</body>

</html>