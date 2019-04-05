<?php require APPROOT.'\views\inc\navbar.php'; ?>

<h1>The login page</h1>

<form action = "<?php echo URLROOT; ?>/users/login" method="post">

    Email <input type="text" name="email" value="<?php echo $data['email']; ?>"><br>
    <span style="color:red"><?php echo $data['email_err']; ?></span><br>
    Password <input type="text" name="password" value="<?php echo $data['password']; ?>"><br>
    <span style="color:red"><?php echo $data['password_err']; ?></span><br>
    <input type="submit" value="Login" ><br>
    <a href="<?php echo URLROOT; ?>/users/register" >No acount? Register</a>
</form>