<?php require APPROOT.'\views\inc\navbar.php'; ?>

<form method="post" action="createAccountAjax" id="ajaxAccount">
    <input type="text" name="name" id="user" placeholder="username"><br>
    <span style="color: red"><?php echo $data['name_err']; ?></span><br>
    <input type="text" name="email" id="em" placeholder="email"><br>
    <input type="password" name="password" id="pass" placeholder="password"><br>
    <input type="submit" name="submit">
</form>
<script>
    document.getElementById('ajaxAccount').addEventListener('submit', postName);

    function postName(e){
        e.preventDefault();

        var name = document.getElementById('user').value;
        var email = document.getElementById('em').value;
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


