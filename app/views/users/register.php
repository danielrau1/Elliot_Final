
<?php require APPROOT.'\views\inc\navbar.php'; ?>

<h1>The register page</h1>

<form action = "<?php echo URLROOT; ?>/users/register" method="post">

    Name <input type="text" name="name" value="<?php echo $data['name']; ?>"><br>
    <span style="color: red"><?php echo $data['name_err']; ?></span><br>

    Email <input type="text" name="email" value="<?php echo $data['email']; ?>"><br>
    <span style="color: red"><?php echo $data['email_err']; ?></span><br>

    Password <input type="text" name="password" value="<?php echo $data['password']; ?>"><br>
    <span style="color: red"><?php echo $data['password_err']; ?></span><br>

    Confirm Password <input type="text" name="confirm_password" value="<?php echo $data['confirm_password']; ?>"><br>
    <span style="color: red"><?php echo $data['confirm_password_err']; ?></span><br>

    <input type="submit" value="Register" ><br>
    <a href="<?php echo URLROOT; ?>/users/login" >Have an account? Login</a>
</form>





