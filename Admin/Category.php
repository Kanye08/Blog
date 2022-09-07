
<?php
include ("dbconnect.php");
include ("function/sessions.php");
include ("function/redirect.php");



if(isset($_POST['submit'])){
    $category=$_POST['cate'];
    $time=gmdate("Y/M/D H:m:s");
    $Admin="Kanye";

    if(empty($category)){
        $_SESSION['errorMessage']="category cannot be empty";
        redirectTo("dashboard.php");
    
    }
    else if(strlen($category)>50){
        $_SESSION['errorMessage']="category cannot be more than 50 characters";
        redirectTo("dashboard.php");
    }

    else{
        $insertQuery="insert into creators(datetime,category,name) values ('$time','$category','$Admin')";
        $execute=mysqli_query($con,$insertQuery);
        if($execute){
            $_SESSION['successMessage']="Category stored successfully";
            redirectTo("category.php");
        }
        else{
            $_SESSION['errorMessage']="Category failed";
            redirectTo("category.php");
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
    <title>Document</title>
    
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>

    
    
    <div class="col-sm-2">
        <?php
            include ("nav.php");
        ?>
    </div>
    <div class="col-sm-10">
        <h1>CATEGORY</h1>
        <?php echo errorMessage();?>
        <?php echo successMessage();?>
        <form action="" method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <legend>Add Category</legend>
                <input type="text" class="form-control" name="cate" placeholder="Enter New Category">
                <br><br>
                <button name="submit" class="btn btn-success btn-block">Save Category</button>
            </div>

        </form>

        <table class="table table-striped table-hover table-bordered">
            <tr>
                <th>S/N</th>
                <th>Datetime</th>
                <th>Category</th>
                <th>Admin</th>
            </tr>
            <?php
                $fetchQuery="select * from creators order by datetime desc";
                $executeFetch=mysqli_query($con,$fetchQuery);
                $sn=0;
                while($rowData=mysqli_fetch_array($executeFetch)){
                    $id=$rowData['id'];
                    $date=$rowData['datetime'];
                    $category=$rowData['category'];
                    $Admin=$rowData['name'];
                       
                    $sn++;
            ?>
            <tr>
                <td><?php echo $sn;?></td>
                <td><?php echo $date;?></td>
                <td><?php echo $category;?></td>
                <td><?php echo $Admin;?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

<?php include("footer.php") ?>
  
</body>
</html>