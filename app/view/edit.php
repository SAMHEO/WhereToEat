<div class="review-content">
  <div class="review-box">
    <div class="review-title">
      <h2>Edit a Review for <?= $dining->dining_name ?></h2>
    </div>
    <div class="review-content">
      <div class="review-content-image">
        <img src="<?= BASE_URL ?>/public/images/user.svg" alt="user image" width="50px" height="50px" />
        <!--<a href="http://www.onlinewebfonts.com">oNline Web Fonts</a>-->
      </div>
      <!-- star rating -->
      <div class="review-content-detail">
        <form id="editReview" method="POST" action="<?= BASE_URL ?>/edit/<?= $review->id ?>/process">

          <div class="rating-group" style="display: flex;">
            <label for="rating">Rating</label>
            <input type="hidden" name="diningName" value="<?= $dining->dining_name ?>" />
            <input type="hidden" name="id" value="<?= $review->id ?>" />
            <input type="radio" name="rating" value="1" <?= $review->rating == 1 ? 'checked' : '' ?> /> 1<br />
            <input type="radio" name="rating" value="2" <?= $review->rating == 2 ? 'checked' : '' ?> /> 2<br />
            <input type="radio" name="rating" value="3" <?= $review->rating == 3 ? 'checked' : '' ?> /> 3<br />
            <input type="radio" name="rating" value="4" <?= $review->rating == 4 ? 'checked' : '' ?> /> 4<br />
            <input type="radio" name="rating" value="5" <?= $review->rating == 5 ? 'checked' : '' ?> /> 5<br />
          </div>
          <div class="review-content-detail-comments">
            <textarea id="review-comment" name="description" rows="4" cols="60" placeholder="<?= $review->comment ?>"></textarea>
          </div>
          <div class="analyzed-text" style="display: none;">Score</div>
          <input type="submit" class="button" value="Edit" />
        </form>
        <!-- star rating -->
      </div>
    </div>
  </div>
</div>