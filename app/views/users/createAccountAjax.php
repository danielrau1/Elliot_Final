<?php require APPROOT.'\views\inc\navbar.php'; ?>

<form method="post" action = "<?php echo URLROOT; ?>/users/createAccountAjax" id="ajaxAccount">

    Name<input type="text" name="name" id="user"  value="<?php echo $data['name']; ?>"><br>
    <span style="color: red"><?php echo $data['name_err']; ?></span><br>

    Email<input type="text" name="email" id="email" ><br>
    Password<input type="password" name="password" id="pass" ><br>
    <input type="submit" name="submit">
</form>
<script>
    document.getElementById('ajaxAccount').addEventListener('submit', postName);

    function postName(e){
        e.preventDefault();

        var name = document.getElementById('user').value;
        var email = document.getElementById('email').value;
        var password=document.getElementById('pass').value;
        var params = "name="+name+"&email="+email +"&password="+password+"&submit=submit";

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost/shareposts2/Users/createAccountAjax', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            console.log(this.responseText);
        }

        xhr.send(params);
    }

</script>


