<!-- Content -->
<div class="detail-content">
  <div class="dining-hall-info">
    <div class="title">
      <h2>Overview</h2>
    </div>
    <div class="info-content">
      <div class="detail-image">
        <img src="<?= $dining->img_url ?>" />
      </div>
      <div class="detail-info">
        <p id="dining-name-<?= $dining->dining_name ?>">Name: <?= $dining->dining_name ?></p>
        <p>Location: <?= $dining->location ?></p>
        <p>Category: <?= $dining->category ?></p>
        <p>Hours of Operation: <?= $dining->hours ?></p>
      </div>
    </div>
  </div>

  <?php if (!isset($_SESSION['loggedInUserID'])) : ?>
    <div id="overlay">
      <div id="text">You must log in to see the reviews</div>
    </div>
  <?php else : ?>
    <div class="comment-button">
      <a href="<?= BASE_URL ?>/<?= $dining->dining_name ?>/review/">
        <button class="button">Share your thought</button>
      </a>
    </div>



    <!-- Review section -->
    <div class="review">
      <div class="review-left">
        <div class="review-left-title">
          <h2>Review</h2>
        </div>

        <hr style="border:3px solid #acacac" />
        <div class="review-left-rating">
          <span class="heading">4.1</span>
          <p>average based on 254 reviews.</p>
        </div>
        <hr style="border:3px solid #acacac" />

        <!-- rating bar -->
        <div class="review-left-stars">
          <div class="row">
            <div class="side">
              <div>5 star</div>
            </div>
            <div class="middle">
              <div class="bar-container">
                <div class="bar-5"></div>
              </div>
            </div>
            <div class="side right">
              <div>150</div>
            </div>
            <div class="side">
              <div>4 star</div>
            </div>
            <div class="middle">
              <div class="bar-container">
                <div class="bar-4"></div>
              </div>
            </div>
            <div class="side right">
              <div>63</div>
            </div>
            <div class="side">
              <div>3 star</div>
            </div>
            <div class="middle">
              <div class="bar-container">
                <div class="bar-3"></div>
              </div>
            </div>
            <div class="side right">
              <div>15</div>
            </div>
            <div class="side">
              <div>2 star</div>
            </div>
            <div class="middle">
              <div class="bar-container">
                <div class="bar-2"></div>
              </div>
            </div>
            <div class="side right">
              <div>6</div>
            </div>
            <div class="side">
              <div>1 star</div>
            </div>
            <div class="middle">
              <div class="bar-container">
                <div class="bar-1"></div>
              </div>
            </div>
            <div class="side right">
              <div>20</div>
            </div>
          </div>
        </div>
      </div>

      <div class="review-right">
        <!-- Overlay when user not logged in -->

        <!-- Displaying User Comments -->
        <?php foreach ($reviews as $review) : ?>
          <div id="user-review-<?= $review->id ?>" class="user-review">
            <div class="user-review-image">
              <?php if ($review->img_url != '') : ?>
                <img src="<?= $review->img_url ?>" alt="" width="50px" />
              <?php else : ?>
                <img src="<?= BASE_URL ?>/public/images/user.svg" width="50px" />
              <?php endif; ?>
            </div>
            <div class="user-review-content">
              <?= createUsernameLink($review->creator_id) ?>
              <p>Rating: <?= $review->rating ?></p>
              <p><?= $review->comment ?></p>
              <p>Reviewed on <?= $review->date_created ?></p>
            </div>

            <!-- <form id="editReview" method="POST" action="<?= BASE_URL ?>/<?= $dining->dining_name ?>/review/edit"> -->
            <!-- only the user who created review or admin can delete or edit -->
            <?php if (($review->creator_id == $_SESSION['loggedInUserID']) || ($_SESSION['loggedInUserRole'] == User::ROLE['admin'])) : ?>
              <a href="<?= BASE_URL ?>/edit/<?= $dining->dining_name ?>/<?= $review->id ?>">
                <button class="button">Edit</button>
              </a>
              <button class="button delete" value="Delete" onClick="confirmDelete()">Delete</button>
              <!-- <form id="deleteReview" method="POST" action="<?= BASE_URL ?>/detail/delete/<?= $review->id ?>" onsubmit="return confirm('Do you really want to delete the review?');">
                <input type="hidden" name="diningName" value="<?= $dining->dining_name ?>" />
                <input type="hidden" name="id" value="<?= $review->id ?>" />
                <input class="button" type="submit" value="Delete" />
              </form> -->
            <?php endif; ?>
          </div>

        <?php endforeach; ?>

        <!-- <div class="user-review">
          <div class="user-review-image">
            <img src="<?= BASE_URL ?>/public/images/user.svg" width="50px" />
          </div>
          <div class="user-review-content">
            <p>Samnyeong Heo</p>
            <p>review rating</p>
            <p>review comment</p>
          </div>
        </div> -->
      </div>
    </div>
</div>
<?php endif; ?>
<!-- Content -->