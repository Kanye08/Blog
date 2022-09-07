<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
<ul class="nav nav-tabs">
    <li id="li">  <?php if(basename($_SERVER['PHP_SELF']) == 'dashboard') echo "class='active'";?> <a  href="dashboard.php"><span class="iconify" data-icon="ic:baseline-space-dashboard"></span>Dashboard</a></li>
    <li id="li">  <?php if(basename($_SERVER['PHP_SELF']) == 'post') echo "class='active'";?> <a  href="post.php"><span class="iconify" data-icon="ic:outline-post-add"></span>Post</a></li>
    <li id="li">  <?php if(basename($_SERVER['PHP_SELF']) == 'category') echo "class='active'";?> <a  href="Category.php"><span class="iconify" data-icon="ic:sharp-category"></span>Category</a></li>
    <li id="li">  <?php if(basename($_SERVER['PHP_SELF']) == 'comment') echo "class='active'";?> <a  href="comment.php"><span class="iconify" data-icon="bxs:comment-detail"></span>Comment</a></li>
    <li id="li">  <?php if(basename($_SERVER['PHP_SELF']) == 'logout') echo "class='active'";?> <a  href="logout.php"><span class="iconify" data-icon="ant-design:logout-outlined"></span>Logout</a></li>
</ul>