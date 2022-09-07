
<?php
include ("dbconnect.php");
include ("function/sessions.php");
include ("function/redirect.php");

if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $category=$_POST['cate'];
    // for uploading images
    $Image=$_FILES['image']['name'];
    $targetFolder="images/" .basename($_FILES['image']['name']);
    $time=gmdate("Y/M/D H:m:s");
    $Admin="Kanye";
    $Post=$_POST['post'];

    if(empty($title)){
        $_SESSION['errorMessage']="Title cannot be empty";
        redirectTo("post.php");
    
    }
    else if(strlen($title)<2){
        $_SESSION['errorMessage']="Title cannot be less than 2 characters";
        redirectTo("post.php");
    }

    else{
        $insertQuery="INSERT into post(title,datetime,category,image,author,post) VALUES ('$title','$time','$category','$Image','$Admin','$Post')";
        $execute=mysqli_query($con,$insertQuery);
        move_uploaded_file($_FILES['image']['tmp_name'],$targetFolder);
        if($execute){
            $_SESSION['successMessage']="Post Added Successfully!";
            redirectTo("post.php");
        }
        else{
            $_SESSION['errorMessage']="Post not Added!";
            redirectTo("post.php");
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
    <title>Add New Post</title>
    
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
        <h1>NEW ARTICLE</h1>
        <?php echo errorMessage();?>
        <?php echo successMessage();?>
        <form action="" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control" name="title" placeholder="Post Title">
            </div>
                <br><br>
                <div class="form-group">
                <input type="text" class="form-control" name="cate" list="cate" placeholder="Pick a Category">
                <datalist id="cate">
                    <?php
                        $fetchQuery="select * from creators order by datetime desc";
                        $executeFetch=mysqli_query($con,$fetchQuery);
                    
                    while($rowData=mysqli_fetch_array($executeFetch)){
                     $id=$rowData['id'];
                    $category=$rowData['category'];
                        
                       
                    
                
                    ?>
                    <option value="<?php echo $category ?>"></option>
                <?php } ?>
                </datalist>
                </div>
                <br><br>

            <div class="form-group">
                <input type="file" class="form-control" name="image">
            </div>
            <br><br>

            <div class="form-group">
                <textarea name="post" placeholder="Enter Post Here" id="input" class="form-control" rows="3" required="required"></textarea>
            </div>

            <button name="submit" class="btn btn-success btn-block">Add Post</button>
            

        </form>

    </div>

<?php include("footer.php") ?>
  
</body>
</html>