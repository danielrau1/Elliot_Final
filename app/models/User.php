<?php
class User{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Register user
    public function register($data){
        $this->db->query( 'INSERT INTO final (name, email, age, username, password) VALUES (:name, :email, :age, :username, :password)');
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':age',$data['age']);
        $this->db->bind(':username',$data['username']);
        $this->db->bind(':password',$data['password']);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Login user
    public function login($name, $username){
        $this->db->query('SELECT * FROM final WHERE username= :username');
        $this->db->bind(':username', $username);
        $row =$this->db->single();
        $hashed_username = $row->username;
        if($username== $hashed_username){
            return $row;
        }else{
            return false;
        }
    }

    // Find user by username
    public function findUserByUsername($username){
        $this->db->query('SELECT * FROM final WHERE username = :username');
        $this->db->bind(':username',$username);
        $row = $this->db->single();
        //check row
        if($this->db->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }


    // *********** THE AJAX PART ********************//

    public function checkUserExists($username)
    {
        $query = "select count(*) from final where username=:username";
        $this->db->query($query);
        $this->db->bind(":username", $username, PDO::PARAM_STR);
        $this->db->execute();
        $rowCount = $this->db->fetchColumn();

        if ($rowCount == 0) {
            //"invalid login"
            return false;
        } else {
            return true;
        }
    }

    public function createAccount($name,$email,$age,$username, $password)
    {
        $alreadyExists = $this->checkUserExists($username);
        if ($alreadyExists) {
            return false;
        }
        $query = "insert into final(name,email,age,username, password) values(:name,:email,:age,:username,:password)";
        $this->db->query($query);
        $this->db->bind(":name", $name);
        $this->db->bind(":email", $email);
        $this->db->bind(":age", $age);
        $this->db->bind(":username", $username);
        $this->db->bind(":password", $password);

        $success = $this->db->execute();
        return $success;
    }


}