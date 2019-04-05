
<form method="post" action="createAccountAjax" id="ajaxAccount">
    <input type="text" name="name" id="user" placeholder="username">
    <input type="text" name="email" id="em" placeholder="email">
    <input type="password" name="password" id="pass" placeholder="password">
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
        xhr.open('POST', 'http://localhost/shareposts/Users/createAccountAjax', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            console.log(this.responseText);
        }

        xhr.send(params);
    }

</script>


