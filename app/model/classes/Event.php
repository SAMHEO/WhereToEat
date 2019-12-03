<?php

class Event
{
  public $id;
  public $event_type;
  public $user_1_id;
  public $user_2_id;
  public $review_id;
  public $data;
  public $date_created;
  const DB_TABLE = 'event';
  const EVENT_TYPE = array(
    'add_review' => 210,
    'delete_review' => 220,
    'update_review' => 230,
    'login' => 110,
    'logout' => 120
  );

  public static function loadAllEvents()
  {

    $events = array();

    $query = "SELECT id FROM " . self::DB_TABLE . " ORDER BY date_created DESC";
    $result = $GLOBALS['conn']->query($query);
    if ($result->num_rows) {
      while ($row = $result->fetch_assoc()) {
        $ev = self::loadByID($row['id']);
        $events[$row['id']] = $ev;
      }
    }

    return $events;
  }

  public static function loadByID($eventID)
  {
    $query = sprintf(
      "SELECT * FROM %s WHERE id = %d",
      self::DB_TABLE,
      $GLOBALS['conn']->real_escape_string($eventID)
    );

    $result = $GLOBALS['conn']->query($query);
    if ($result->num_rows) {
      $row = $result->fetch_assoc();
      $ev = new Event();
      $ev->id = $row['id'];
      $ev->event_type = $row['event_type'];
      $ev->user_1_id = $row['user_1_id'];
      $ev->user_2_id = $row['user_2_id'];
      $ev->review_id = $row['review_id'];
      $ev->data = $row['data'];
      $ev->date_created = $row['date_created'];
      return $ev;
    } else {
      return null;
    }
  }

  public static function loadByUserID($userID)
  {
    $events = array();

    $query = sprintf(
      "SELECT id FROM %s WHERE user_1_id = %d",
      self::DB_TABLE,
      $GLOBALS['conn']->real_escape_string($userID)
    );

    $result = $GLOBALS['conn']->query($query);

    if ($result->num_rows) {
      while ($row = $result->fetch_assoc()) {
        $ev = self::loadByID($row['id']);
        $events[$row['id']] = $ev;
      }
    }

    return $events;
  }

  private static function checkIfNull($val)
  {
    if ($val == null) {
      return 'NULL';
    } elseif (is_numeric($val)) {
      return $val;
    } else {
      "'" . $val . "'";
    }
  }

  public static function insertEvent($event)
  {
    $query = sprintf(
      "INSERT INTO %s (event_type, user_1_id, user_2_id, review_id, data) VALUES (%d, %d, %s, %s, %s) ",
      self::DB_TABLE,
      $GLOBALS['conn']->real_escape_string($event->event_type),
      $GLOBALS['conn']->real_escape_string($event->user_1_id),
      self::checkIfNull($GLOBALS['conn']->real_escape_string($event->user_2_id)),
      self::checkIfNull($GLOBALS['conn']->real_escape_string($event->review_id)),
      self::checkIfNull($GLOBALS['conn']->real_escape_string($event->data))
    );
    //    echo $query;
    $result = $GLOBALS['conn']->query($query);
    if ($result) {
      $eventID = $GLOBALS['conn']->insert_id;
      $ev = self::loadByID($eventID);
      return $ev;
    } else {
      return null;
    }
  }
}
