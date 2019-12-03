<?php

class UserReview
{

    public $id;
    public $diningName;
    public $creator;
    public $creator_id;
    public $rating;
    public $commment;
    public $date_created;
    public $img_url;
    const DB_TABLE = 'user_review';
    const DB_EVENT = 'event';

    public static function loadAllReview()
    {

        $allReviews = array();

        $query = "SELECT * FROM " . self::DB_TABLE . " ORDER BY date_created DESC";
        $result = $GLOBALS['conn']->query($query);

        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $rv = new UserReview();
                $rv->id = $row['id'];
                $rv->diningName = $row['diningName'];
                $rv->creator = $row['creator'];
                $rv->creator_id = $row['creator_id'];
                $rv->rating = $row['rating'];
                $rv->comment = $row['comment'];
                $rv->date_created = $row['date_created'];
                $rv->img_url = $row['img_url'];

                $allReviews[$row['id']] = $rv;
            }
        }
        return $allReviews;
    }

    public static function loadByName($diningName)
    {
        $reviews = array();

        $query = sprintf(
            "SELECT * FROM %s WHERE diningName = '%s' ORDER BY date_created ASC",
            self::DB_TABLE,
            $GLOBALS['conn']->real_escape_string($diningName)
        );

        $result = $GLOBALS['conn']->query($query);

        if ($result->num_rows) {

            while ($row = $result->fetch_assoc()) {
                $rv = new UserReview();
                $rv->id = $row['id'];
                $rv->diningName = $row['diningName'];
                $rv->creator = $row['creator'];
                $rv->creator_id = $row['creator_id'];
                $rv->rating = $row['rating'];
                $rv->comment = $row['comment'];
                $rv->date_created = $row['date_created'];
                $rv->img_url = $row['img_url'];

                $reviews[] = $rv;
            }
        }
        return $reviews;
    }

    public static function loadByID($reviewID)
    {
        $query = sprintf(
            "SELECT * FROM %s WHERE id = %d",
            self::DB_TABLE,
            $GLOBALS['conn']->real_escape_string($reviewID)
        );

        $result = $GLOBALS['conn']->query($query);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $rv = new UserReview();
            $rv->id = $row['id'];
            $rv->diningName = $row['diningName'];
            $rv->creator = $row['creator'];
            $rv->creator_id = $row['creator_id'];
            $rv->rating = $row['rating'];
            $rv->comment = $row['comment'];
            $rv->date_created = $row['date_created'];
            $rv->img_url = $row['img_url'];

            return $rv;
        } else {
            return null;
        }
    }

    public static function insertReview($review)
    {
        // $query = "INSERT INTO user_review (diningName, username, rating, comment, img_url) VALUES ('Origami', 'Sam', 4, 'TEST', NULL)";
        $query = sprintf(
            "INSERT INTO %s (diningName, creator, creator_id, rating, comment) VALUES ('%s', '%s', %d, %d, '%s')",
            self::DB_TABLE,
            $GLOBALS['conn']->real_escape_string($review->diningName),
            $GLOBALS['conn']->real_escape_string($review->creator),
            $GLOBALS['conn']->real_escape_string($review->creator_id),
            $GLOBALS['conn']->real_escape_string($review->rating),
            $GLOBALS['conn']->real_escape_string($review->comment)
        );

        $result = $GLOBALS['conn']->query($query);
        if ($result) {
            $reviewID = $GLOBALS['conn']->insert_id;
            $nr = self::loadByID($reviewID);
            return $nr;
        } else {
            return null;
        }
    }

    public static function editReview($review)
    {
        // $query = "UPDATE user_review SET rating = 0, comment = 'Hello' WHERE id = $review->id";
        $query = sprintf(
            "UPDATE %s SET rating = %d, comment = '%s' WHERE id = %d",
            self::DB_TABLE,
            $GLOBALS['conn']->real_escape_string($review->rating),
            $GLOBALS['conn']->real_escape_string($review->comment),
            $GLOBALS['conn']->real_escape_string($review->id)
        );

        $result = $GLOBALS['conn']->query($query);
        if ($result) {
            $updated = self::loadByID($review->id);
            return $updated;
        } else {
            return null;
        }
    }

    public static function deleteReview($review)
    {
        // DELETE FROM `event` WHERE review_id = 64;
        // DELETE FROM `user_review` WHERE 0

        // Delete row from event table first b/c of the foreign key contraint
        $query1 = sprintf(
            "DELETE FROM %s WHERE review_id = %d",
            self::DB_EVENT,
            $GLOBALS['conn']->real_escape_string($review->id)
        );
        // echo $query1;
        $result = $GLOBALS['conn']->query($query1);

        // Delete row from user_review table
        $query2 = sprintf(
            "DELETE FROM %s WHERE id = %d",
            self::DB_TABLE,
            $GLOBALS['conn']->real_escape_string($review->id)
        );
        // echo $query2;

        $result = $GLOBALS['conn']->query($query2);
    }
}
