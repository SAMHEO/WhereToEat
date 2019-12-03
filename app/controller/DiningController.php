<?php

include_once '../global.php';
// include_once '../model/classes/UserReview.php';

$route = $_GET['route'];

$dc = new DiningController();

if ($route == 'dining') {
    $dc->dining();
} elseif ($route == 'detail') {
    $dc->detail();
} elseif ($route == 'review') {
    $dc->review();
} elseif ($route == 'addReview') {
    $dc->addReview();
} elseif ($route == 'editReview') {
    $dc->editReview();
} elseif ($route == 'editReviewProcess') {
    $dc->editProcess();
} elseif ($route == 'deleteReview') {
    $dc->deleteProcess();
} elseif ($route == 'readDining') {
    $dc->readDining();
}

class DiningController
{
    public function index()
    {
        $pageTitle = "Home";

        include_once SYSTEM_PATH . '/view/header.php';
        include_once SYSTEM_PATH . '/view/index.php';
        include_once SYSTEM_PATH . '/view/footer.php';
    }

    public function dining()
    {
        $pageTitle = "Dining";

        $query = "SELECT * FROM dining ORDER BY dining_name ASC";
        $result = $GLOBALS['conn']->query($query);

        $reviews = UserReview::loadAllReview();
        $events = Event::loadAllEvents();

        include_once SYSTEM_PATH . '/view/header.php';
        include_once SYSTEM_PATH . '/view/dining.php';
        include_once SYSTEM_PATH . '/view/footer.php';
    }

    public function detail()
    {
        $diningName = $_GET['diningName'];

        $dining = Dining::loadByName($diningName);
        $reviews = UserReview::loadByName($diningName);

        $pageTitle = "Detail";

        include_once SYSTEM_PATH . '/view/header.php';
        include_once SYSTEM_PATH . '/view/detail.php';
        include_once SYSTEM_PATH . '/view/footer.php';
    }

    public function review()
    {
        $diningName = $_GET['diningName'];
        $dining = Dining::loadByName($diningName);
        $script = 'review';

        $pageTitle = "Review";

        include_once SYSTEM_PATH . '/view/header.php';
        include_once SYSTEM_PATH . '/view/review.php';
        include_once SYSTEM_PATH . '/view/footer.php';
    }

    public function addReview()
    {
        // get form data
        $diningName = $_POST['diningName'];
        $comment = $_POST['description'];
        $rating = $_POST['rating'];

        // save new UserReview to database
        $review = new UserReview();
        $review->diningName = $diningName;
        $review->creator_id = $_SESSION['loggedInUserID'];
        $review->rating = $rating;
        $review->comment = $comment;
        $review = UserReview::insertReview($review);

        // log the event
        $ev = new Event();
        $ev->event_type = Event::EVENT_TYPE['add_review'];
        $ev->user_1_id = $review->creator_id;
        $ev->review_id = $review->id;
        $ev = Event::insertEvent($ev);

        // redirect user to the dining hall page
        header('Location: ' . BASE_URL . '/detail/show/' . $review->diningName);
        exit();
    }

    public function editReview()
    {
        $script = 'review';
        $diningName = $_GET['name'];
        $dining = Dining::loadByName($diningName);

        $reviewID = $_GET['reviewID'];
        $review = UserReview::loadByID($reviewID);

        $pageTitle = "Edit";

        include_once SYSTEM_PATH . '/view/header.php';
        include_once SYSTEM_PATH . '/view/edit.php';
        include_once SYSTEM_PATH . '/view/footer.php';
    }

    public function editProcess()
    {
        // get form data
        $diningName = $_POST['diningName'];
        $id = $_POST['id'];
        $comment = $_POST['description'];
        $rating = $_POST['rating'];

        // save new UserReview to database
        $review = new UserReview();
        $review->id = $id;
        $review->diningName = $diningName;
        $review->rating = $rating;
        $review->comment = $comment;
        $review = UserReview::editReview($review);

        // log the event
        $ev = new Event();
        $ev->event_type = Event::EVENT_TYPE['update_review'];
        $ev->user_1_id = $review->creator_id;
        $ev->review_id = $review->id;
        $ev = Event::insertEvent($ev);

        // redirect to detail page for that dining
        header('Location: ' . BASE_URL . '/detail/show/' . $review->diningName);
        exit();
    }

    public function deleteProcess()
    {
        $id = $_POST['review_id'];
        $diningName = $_POST['dining_name'];
        $reviews = UserReview::loadByName($diningName);

        if ($reviews == null) {
            $json = array(
                'error' => 'Invalid review ID'
            );
        } else {
            $review = new UserReview();
            $review->id = $id;
            $review = UserReview::deleteReview($review);

            $json = array(
                'success' => 'success',
                'id' => $id
            );
        }

        // log the event
        $ev = new Event();
        $ev->event_type = Event::EVENT_TYPE['delete_review'];
        $ev->user_1_id = $_SESSION['loggedInUserID'];
        $ev = Event::insertEvent($ev);

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // Helper function to retreive search result from database and to display in search box
    public function readDining()
    {
        if (!empty($_GET["keyword"])) {
            $diningName = $_GET["keyword"];
            $dinings = Dining::loadMultipleByName($diningName);

            include_once SYSTEM_PATH . '/view/readDining.php';
        }
    }
}
