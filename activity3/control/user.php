<?php


class user
{
    function connect() {
        require_once 'config.php';
        $conn = new mysqli(HOST, USER, PW, DB);
        return $conn;
    }
    function addNewUser($username, $password) {
        $result = false;
        $cn = $this->connect();
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO mit_user (username,password) VALUES(?,?)";
        $qry = $cn->prepare($sql);
        $qry->bind_param("ss", $username, $password);
        if($qry->execute()) {
            $result = true;
        }
        return $result;
    }
    function registerNewUser($username, $password) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $result = false;
        $cn = $this->connect();
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO mit_user (username,password) VALUES(?,?)";
        $qry = $cn->prepare($sql);
        $qry->bind_param("ss", $username, $password);
        if($qry->execute()) {
            $_SESSION['username'] = $username;
            $result = true;
        }
        return $result;
    }
    function checkIfUserExist($username){
        $cn = $this->connect();
        $result = 0;
        $username = filter_var($username, FILTER_SANITIZE_STRING);

        $sql = "SELECT COUNT(*) FROM mit_user WHERE username=?";
        $qry = $cn->prepare($sql);
        $qry->bind_param("s", $username);
        $qry->bind_result($result);
        $qry->execute();
        $qry->fetch();

        return $result;
    }

    function getAllUsers() {
        $cn = $this->connect();
        $result = array();
        $sql = "SELECT username FROM mit_user ORDER BY username";
        $qry = $cn->prepare($sql);
        $qry->bind_result($username);
        $qry->execute();
        while($qry->fetch()) {
            $result[] = $username;
        }
        return $result;
    }
    function authenticate($username, $password) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $cn = $this->connect();
        $hpassword = "";
        $result = false;
        $username = filter_var($username, FILTER_SANITIZE_STRING);

        $sql = "SELECT username,password FROM mit_user WHERE username=?";
        $qry = $cn->prepare($sql);
        $qry->bind_param("s", $username);
        $qry->bind_result($username, $hpassword);
        $qry->execute();
        $qry->fetch();

        if(password_verify($password,  $hpassword)) {
            $_SESSION['username'] = $username;
            $result = true;
        }
        return $result;
    }
    function deleteUser($username) {
        $result = false;
        $cn = $this->connect();
        $username = filter_var($username, FILTER_SANITIZE_STRING);

        $sql = "DELETE FROM mit_user WHERE username=?";
        $qry = $cn->prepare($sql);
        $qry->bind_param("s", $username);
        if($qry->execute()) {
            $result = true;
        }
        return $result;
    }
    function updateUser($username, $password) {
        //update user
        $result = false;
        $cn = $this->connect();
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE mit_user SET password=? WHERE username=?";
        $qry = $cn->prepare($sql);
        $qry->bind_param("ss", $password, $username);
        if($qry->execute()) {
            $result = true;
        }
        return $result;
    }
}