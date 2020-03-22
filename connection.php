<?php

class Database {

    private static $uname = 'root';
    private static $psswd = '';
    private static $dsn = 'mysql:host=localhost;dbname=surveybank';
    private static $dbcon;

    public static function connectDB(){
        if(!isset(self::$dbcon)){
            try {
                self::$dbcon = new PDO(self::$dsn, self::$uname, self::$psswd);
                self::$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$dbcon->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                $msg = $e->getMessage();
                echo $msg;
            }
        }
        return self::$dbcon;
    }

    public static function checkUserCreds($email, $password){
        $users = self::$dbcon->prepare("SELECT * FROM users");
        $users->execute();
        $users = $users->fetchAll();
        foreach($users as $user){
            if($user->user_email == $email and $user->user_password == $password)
                return $user;
        }
        return null;
    }

    public static function registerUser($fname, $lname, $email, $password){
        $query = 'INSERT INTO users (user_fname, user_lname, user_email, user_password, user_isAdmin)
                    VALUES (?,?,?,?,?);';
        $newUser = self::$dbcon->prepare($query);
        $newUser->execute([$fname, $lname, $email, $password, 0]);
        if($newUser)
            return self::$dbcon->lastInsertId();
        
        return false;
    }

}

?>