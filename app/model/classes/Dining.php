<?php

class Dining
{

    public $id;
    public $dining_name;
    public $location;
    public $category;
    public $hours;
    public $rating;
    public $img_url;

    const DB_TABLE = 'dining';

    public static function loadAllDining()
    {

        $allDinings = array();

        $query = "SELECT * FROM " . self::DB_TABLE . "";
        $result = $GLOBALS['conn']->query($query);

        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $dining = new Dining();
                $dining->id = $row['id'];
                $dining->dining_name = $row['dining_name'];
                $dining->location = $row['location'];
                $dining->category = $row['category'];
                $dining->hours = $row['hours'];
                $dining->rating = $row['rating'];
                $dining->img_url = $row['img_url'];

                $allDinings[$row['id']] = $dining;
            }
        }
        return $allDinings;
    }

    public static function loadByName($diningName)
    {

        $query = sprintf(
            "SELECT * FROM %s WHERE dining_name = '%s'",
            self::DB_TABLE,
            $GLOBALS['conn']->real_escape_string($diningName)
        );

        $result = $GLOBALS['conn']->query($query);
        if ($result->num_rows) {

            $row = $result->fetch_assoc();
            $dining = new Dining();
            $dining->id = $row['id'];
            $dining->dining_name = $row['dining_name'];
            $dining->location = $row['location'];
            $dining->category = $row['category'];
            $dining->hours = $row['hours'];
            $dining->rating = $row['rating'];
            $dining->img_url = $row['img_url'];

            return $dining;
        } else {
            return null;
        }
    }

    public static function loadByID($reviewID)
    {
        $query = sprintf(
            "SELECT * FROM %S WHERE id = %d",
            self::DB_TABLE,
            $GLOBALS['conn']->real_escape_string($reviewID)
        );

        $result = $GLOBALS['conn']->query($query);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $dining = new Dining();
            $dining->id = $row['id'];
            $dining->dining_name = $row['dining_name'];
            $dining->location = $row['location'];
            $dining->category = $row['category'];
            $dining->hours = $row['hours'];
            $dining->rating = $row['rating'];
            $dining->img_url = $row['img_url'];

            return $dining;
        } else {
            return null;
        }
    }

    // Finds all dining halls names that are similar to what we are looking for
    public static function loadMultipleByName($diningName)
    {
        $allDinings = array();

        // SELECT * FROM `dining` WHERE dining_name LIKE 'Qdo%';
        $query = "SELECT * FROM " . self::DB_TABLE . " WHERE dining_name like '" . $diningName . "%' ORDER BY dining_name ASC";

        $result = $GLOBALS['conn']->query($query);

        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $dining = new Dining();
                $dining->id = $row['id'];
                $dining->dining_name = $row['dining_name'];
                $dining->location = $row['location'];
                $dining->category = $row['category'];
                $dining->hours = $row['hours'];
                $dining->rating = $row['rating'];
                $dining->img_url = $row['img_url'];

                $allDinings[$row['id']] = $dining;
            }
        }
        return $allDinings;
    }
}
