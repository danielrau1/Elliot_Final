<?php
/**
 * Created by PhpStorm.
 * User: egimple
 * Date: 2019-04-03
 * Time: 10:18 PM
 */

class AccountModel
{
    private $db1 = null;

    public function __construct()
    {
        $this->db1 = new Database();
    }

    public function checkUserExists($name)
    {
        $query = "select count(*) from users where name=:name";
        $this->db1->query($query);
        $this->db1->bind(":name", $name, PDO::PARAM_STR);
        $this->db1->execute();
        $rowCount = $this->db1->fetchColumn();

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
        $query = "insert into users(name,email,password) values(:name,:email,:password)";
        $this->db1->query($query);
        $this->db1->bind(":name", $name);
        $this->db1->bind(":email", $email);
        $this->db1->bind(":password", $password);

        $success = $this->db1->execute();
        return $success;
    }

}