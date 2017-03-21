<?php

class Model_Auth extends Model
{

    private $playerModel;

    function __construct()
    {
        parent::__construct();
        $this->playerModel = new Model_Player();
    }

    public function isUserRegistered($username, $password = '')
    {
        $info = array();

        $password = $this->encryptPassword($password);
        $result = $this->db->query("SELECT id, password FROM users WHERE username='$username'");
        if(mysqli_num_rows($result) == 0)
        {
            $info['result'] = 0; // not exists
        }
        else
        {
            $row = mysqli_fetch_assoc($result);
            if ($row['password'] == $password) {
                $info['result'] = 1; // exists
                $info['id'] = $row['id'];
            } else {
                $info['result'] = 2; // wrong password
                $info['id'] = $row['id'];
            }
        }
        return $info;
    }



    public function registerUser($username, $password)
    {
        $info = array();

        $password = $this->encryptPassword($password);
        $result = $this->db->query("INSERT INTO users(`username`,`password`) VALUES ('$username', '$password')") or die(mysqli_error($this->db));

        if($result === TRUE)
        {
            $info['result'] = 1;
            $result2 = $this->db->query("SELECT id FROM users WHERE username='$username'");
            $row = mysqli_fetch_assoc($result2);
            $info['id'] = $row['id'];
            $this->playerModel->createPlayerInfo($row['id']);
        }
        else
            $info['result'] = 0;
        return $info;
    }

    public function signout($user_id = null) //signout self
    {
        if(isset($_SESSION['id']))
            unset($_SESSION['id']);
        if(isset($_SESSION['username']))
            unset($_SESSION['username']);
        if(isset($_COOKIE['session_hash']))
            unset($_COOKIE['session_hash']);

        setcookie('session_hash', '', time() - 3600, '/');

        if($user_id != null)
            $this->db->query("UPDATE users SET session='' WHERE id='$user_id'");
    }

    public function isSignedIn()
    {
        $info = array();
        $info['result'] = 0;
        if(isset($_SESSION['id']) && isset($_COOKIE['session_hash']) && isset($_SESSION['username']))
        {
            $result = $this->db->query("SELECT session FROM users WHERE id=" . $_SESSION['id']);
            $row = mysqli_fetch_assoc($result);
            if($row['session'] == $_COOKIE['session_hash'])
                $info['result'] = 1;
        }
        return $info;
    }

    public function authentificate($user_id)
    {
        $info = array();
        $this->signout($user_id);
        $sessionHash = $this->generateRandomString(50);
        setcookie('session_hash', $sessionHash, time() + 60*60*24, '/');
        $_COOKIE['session_hash'] = $sessionHash;
        $_SESSION['id'] = $user_id;
        $result = $this->db->query("UPDATE users SET session='$sessionHash' WHERE id='$user_id'");
        if($result === TRUE) {
            $info['result'] = 1;
            $result2 = $this->db->query("SELECT u.username,p.location_id FROM users u JOIN player_info p ON(u.id=p.user_id) WHERE u.id='$user_id'");
            $row2 = mysqli_fetch_assoc($result2);
            $_SESSION['username'] = $row2['username'];
            $_SESSION['location_id'] = $row2['location_id'];
        }
        else
            $info['result'] = 0;
        return $info;

    }



    public function getUserInfo($userId)
    {
        $info = array();
        $result = $this->db->query("SELECT username, session FROM users WHERE id='$userId'");
        $row = mysqli_fetch_assoc($result);
        $info['online'] = ($row['session']==""?0:1);
        $info['username'] = $row['username'];
        return $info;
    }

    private function encryptPassword($password)
    {
        return md5(md5($password));
    }

    private function generateRandomString($length = 50) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}