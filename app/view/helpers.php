<?php

function createUsernameLink($userID)
{
    $user = User::loadByID($userID);
    $formatted = '<a href="' . BASE_URL . '/user/' . $user->username . '">' . $user->username . '</a>';
    return $formatted;
}

function formatEvent($ev)
{
    switch ($ev->event_type) {
        case Event::EVENT_TYPE['add_review']:
            // [User] rated [rating] start for "[Dining]." [Date]
            $review = UserReview::loadByID($ev->review_id);
            $formatted = createUsernameLink($ev->user_1_id) . ' rated ' . $review->rating . ' star for <strong>"' . $review->diningName . '"</strong>  <br>' . $ev->date_created;
            break;

        case Event::EVENT_TYPE['delete_review']:
            // [User] deleted review for "[Dining]." [Date]
            $formatted = createUsernameLink($ev->user_1_id) . ' deleted review <br>' . $ev->date_created;
            break;

        case Event::EVENT_TYPE['update_review']:
            // [User] has updated review for "[Dining]." [Date]
            $review = UserReview::loadByID($ev->review_id);
            $formatted = createUsernameLink($ev->user_1_id) . ' has updated review for "' . $review->diningName . '" <br>' . $ev->date_created;
            break;

        case Event::EVENT_TYPE['login']:
            // [User] has logged in. [Date]
            $review = UserReview::loadByID($ev->review_id);
            $formatted = createUsernameLink($ev->user_1_id) . ' has logged in. <br>' . $ev->date_created;
            break;

        case Event::EVENT_TYPE['logout']:
            // [User] has logged out. [Date]
            $review = UserReview::loadByID($ev->review_id);
            $formatted = createUsernameLink($ev->user_1_id) . ' has logged out. <br>' . $ev->date_created;
            break;

        default:
            $formatted = 'Unrecognized event type.';
            break;
    }
    return $formatted;
}
