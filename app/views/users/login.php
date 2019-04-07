<?php require APPROOT.'\views\inc\navbar.php'; ?>

<h1>The login page</h1>

<form action = "<?php echo URLROOT; ?>/users/login" method="post">

    Name <input type="text" name="name" value="<?php echo $data['name']; ?>"><br>
    <span style="color:red"><?php echo $data['name_err']; ?></span><br>
    Username <input type="text" name="username" value="<?php echo $data['username']; ?>"><br>
    <span style="color:red"><?php echo $data['username_err']; ?></span><br>
    <input type="submit" value="Login" ><br>
    <a href="<?php echo URLROOT; ?>/users/register" >No acount? Register</a>
</form>