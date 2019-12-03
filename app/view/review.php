<div class="review-content">
  <div class="review-box">
    <div class="review-title">
      <h2>Write a Review for <?= $dining->dining_name ?></h2>
    </div>
    <div class="review-content">
      <div class="review-content-image">
        <img src="<?= BASE_URL ?>/public/images/user.svg" alt="user image" width="50px" height="50px" />
        <!--<a href="http://www.onlinewebfonts.com">oNline Web Fonts</a>-->
      </div>
      <!-- star rating -->
      <div class="review-content-detail">
        <form id="submitReview" method="POST" action="<?= BASE_URL ?>/<?= $dining->dining_name ?>/review/submit">

          <div class="rating-group" style="display: flex;">
            <label for="rating">Rating</label>
            <input type="hidden" name="diningName" value="<?= $dining->dining_name ?>" />
            <input type="radio" name="rating" value="1" /> 1<br />
            <input type="radio" name="rating" value="2" /> 2<br />
            <input type="radio" name="rating" value="3" /> 3<br />
            <input type="radio" name="rating" value="4" /> 4<br />
            <input type="radio" name="rating" value="5" /> 5<br />
          </div>
          <div class="review-content-detail-comments">
            <textarea id="review-comment" name="description" rows="4" cols="60" placeholder="Leave your comments"></textarea>
          </div>
          <div class="analyzed-text" style="display: none;">Score</div>
          <input type="submit" class="button" value="Submit" />
        </form>
        <!-- star rating -->
      </div>
    </div>
  </div>
</div>