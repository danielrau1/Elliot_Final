<?php
class User{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Register user
    public function register($data){
        $this->db->query( 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Login user
    public function login($email, $password){
        $this->db->query('SELECT * FROM users WHERE email= :email');
        $this->db->bind(':email', $email);
        $row =$this->db->single();
        $hashed_password = $row->password;
        if($password== $hashed_password){
            return $row;
        }else{
            return false;
        }
    }

    // Find user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email',$email);
        $row = $this->db->single();
        //check row
        if($this->db->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }


    // *********** THE AJAX PART ********************//

    public function checkUserExists($name)
    {
        $query = "select count(*) from users where name=:name";
        $this->db->query($query);
        $this->db->bind(":name", $name, PDO::PARAM_STR);
        $this->db->execute();
        $rowCount = $this->db->fetchColumn();

        if ($rowCount == 0) {
            //"invalid login"
            return false;
        } else {
            return true;
        }
    }

    public function createAccount($name,$email, $password)
    {
        $alreadyExists = $this->checkUserExists($name);
        if ($alreadyExists) {
            return false;
        }
        $query = "insert into users(name,email, password) values(:name,:email,:password)";
        $this->db->query($query);
        $this->db->bind(":username", $name);
        $this->db->bind(":email", $email);
        $this->db->bind(":password", $password);

        $success = $this->db->execute();
        return $success;
    }


}