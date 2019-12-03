<?php

class User
{

    public $id;
    public $firstname;
    public $lastname;
    public $username;
    public $password;
    public $email;
    public $gender;
    public $role;
    public $date_registered;
    const DB_TABLE = 'user';
    const ROLE = array(
        'regular' => 0,
        'admin' => 1
    );

    public static function loadAllUsers()
    {

        $users = array();

        $query = "SELECT * FROM " . self::DB_TABLE . " ORDER BY id ASC";
        $result = $GLOBALS['conn']->query($query);

        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $us = new User();
                $us->id = $row['id'];
                $us->firstname = $row['firstname'];
                $us->lastname = $row['lastname'];
                $us->username = $row['username'];
                $us->password = $row['password'];
                $us->email = $row['email'];
                $us->gender = $row['gender'];
                $us->role = $row['role'];
                $us->date_registered = $row['date_registered'];

                $users[$row['id']] = $us;
            }
        }
        return $users;
    }

    public static function loadByUsername($username)
    {

        $query = sprintf(
            "SELECT id FROM %s WHERE username = '%s'",
            self::DB_TABLE,
            $GLOBALS['conn']->real_escape_string($username)
        );

        $result = $GLOBALS['conn']->query($query);

        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            return self::loadByID($row['id']);
        } else {
            return null;
        }
    }

    public static function loadByID($userID)
    {
        $query = sprintf(
            "SELECT * FROM %s WHERE id = %d",
            self::DB_TABLE,
            $GLOBALS['conn']->real_escape_string($userID)
        );

        $result = $GLOBALS['conn']->query($query);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $us = new User();
            $us->id = $row['id'];
            $us->firstname = $row['firstname'];
            $us->lastname = $row['lastname'];
            $us->username = $row['username'];
            $us->password = $row['password'];
            $us->email = $row['email'];
            $us->gender = $row['gender'];
            $us->role = $row['role'];
            $us->date_registered = $row['date_registered'];

            return $us;
        } else {
            return null;
        }
    }

    public static function insertUser($user)
    {
        // $query = "INSERT INTO user (diningName, username, rating, comment, img_url) VALUES ('Origami', 'Sam', 4, 'TEST', NULL)";
        $query = sprintf(
            "INSERT INTO %s (firstname, lastname, username, password, email, gender) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
            self::DB_TABLE,
            $GLOBALS['conn']->real_escape_string($user->firstname),
            $GLOBALS['conn']->real_escape_string($user->lastname),
            $GLOBALS['conn']->real_escape_string($user->username),
            $GLOBALS['conn']->real_escape_string($user->password),
            $GLOBALS['conn']->real_escape_string($user->email),
            $GLOBALS['conn']->real_escape_string($user->gender)
        );

        $result = $GLOBALS['conn']->query($query);
        if ($result) {
            $userID = $GLOBALS['conn']->insert_id;
            $nu = self::loadByID($userID);
            return $nu;
        } else {
            return null;
        }
    }

    public static function changePassword($user)
    {
        // UPDATE `user` SET `password` = 'password1' WHERE `user`.`id` = 17;
        $query = sprintf(
            "UPDATE %s SET password = '%s' WHERE id = %d",
            self::DB_TABLE,
            $GLOBALS['conn']->real_escape_string($user->password),
            $GLOBALS['conn']->real_escape_string($user->id)
        );

        $result = $GLOBALS['conn']->query($query);
    }

    public static function updateRole($user)
    {
        // UPDATE user SET role = 1 WHERE id = 1;
        $query = sprintf(
            "UPDATE %s SET role = %d WHERE id = %d",
            self::DB_TABLE,
            $GLOBALS['conn']->real_escape_string($user->role),
            $GLOBALS['conn']->real_escape_string($user->id)
        );

        $result = $GLOBALS['conn']->query($query);

        if ($result) {
            $updated = self::loadByID($user->id);
            return $updated;
        } else {
            return null;
        }
    }
}
