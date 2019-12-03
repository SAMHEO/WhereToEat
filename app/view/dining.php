    <div class="dining-content">
      <div class="content-left">
        <p>Sort by</p>
        <div class="content-left list">
          <ul>
            <li>Rating</li>
            <li>Name</li>
            <li>Price</li>
            <li>Category</li>
          </ul>
        </div>
      </div>
      <!-- Side Nav-->

      <!-- Main content -->


      <!-- Dining Hall Box -->
      <div class="content-middle">

        <?php while ($row = $result->fetch_assoc()) : ?>

          <div class="dining-hall-box">
            <div class="dining-hall-box-img">
              <?php if ($row['img_url'] != '') : ?>
                <img src="<?= $row['img_url'] ?>" alt="" width="50px" />
              <?php else : ?>
                <img src="<?= BASE_URL ?>/public/images/Qdoba_Logo.svg" width="50px" />
              <?php endif; ?>
            </div>
            <div class="dining-hall-box-info">
              <h2><span style="color: rgb(214, 73, 73)"><?= $row['dining_name'] ?></span></h2>
              <p><?= $row['location'] ?></p>
              <p><?= $row['category'] ?></p>
              <p><?= $row['hours'] ?></p>
              <a href="<?= BASE_URL ?>/detail/show/<?= $row['dining_name'] ?>">
                <button class="button">
                  Details
                </button>
              </a>
            </div>
            <div class="dining-halls-box-rating"></div>
          </div>

        <?php endwhile; ?>

        <!-- <div class="dining-hall-box">
          <div class="dining-hall-box-img">
            <img src="<?= BASE_URL ?>/public/images/Qdoba_Logo.svg" />
          </div>
          <div class="dining-hall-box-info">
            <h2><span style="color: rgb(214, 73, 73)">Qdoba</span></h2>
            <p>Turner Place</p>
            <p>Mexican Restaurant</p>
            <p>Hours of Operation</p>
            <a href="detail">
              <button class="button">
                Details
              </button>
            </a>
          </div>
          <div class="dining-halls-box-rating"></div>
        </div> -->
        <!-- Dining Hall Box -->

        <!-- <div class="dining-hall-box">
          <div class="dining-hall-box-img">
            <img src="<?= BASE_URL ?>/public/images/Turner_place.png" />
          </div>
          <div class="dining-hall-box-info">
            <h2><span style="color: rgb(214, 73, 73)">Origami</span></h2>
            <p>Turner Place</p>
            <p>Mexican Restaurant</p>
            <p>Hours of Operation</p>
            <a href="detail">
              <button class="button">
                Details
              </button>
            </a>
          </div>
          <div class="dining-hall-box-rating"></div>
        </div>

        <div class="dining-hall-box">
          <div class="dining-hall-box-img">
            <img src="<?= BASE_URL ?>/public/images/Burger37.jpg" />
          </div>
          <div class="dining-hall-box-info">
            <h2><span style="color: rgb(214, 73, 73)">Burger '37</span></h2>
            <p>Turner Place</p>
            <p>Mexican Restaurant</p>
            <p>Hours of Operation</p>
            <a href="detail">
              <button class="button">
                Details
              </button>
            </a>
          </div>
          <div class="dining-hall-box-rating"></div>
        </div>

        <div class="dining-hall-box">
          <div class="dining-hall-box-img">
            <img src="<?= BASE_URL ?>/public/images/Qdoba_Logo.svg" />
          </div>
          <div class="dining-hall-box-info">
            <h2><span style="color: rgb(214, 73, 73)">Qdoba</span></h2>
            <p>Turner Place</p>
            <p>Mexican Restaurant</p>
            <p>Hours of Operation</p>
            <a href="detail">
              <button class="button">
                Details
              </button>
            </a>
          </div>
          <div class="dining-hall-box-rating"></div>
        </div> -->
      </div>
      <!-- Main content -->

      <div class="content-right">
        <div class="recent-comments">
          <div class="recent-comments-title">
            <h2>Last Comment:</h2>
          </div>
          <!-- populate all events -->
          <?php if (count($events) > 0) : ?>
            <ul>
              <?php foreach ($events as $event) : ?>
                <li><?= formatEvent($event) ?></li>
              <?php endforeach; ?>
            </ul>
          <?php else : ?>
            <p>No recent activity yet.</p>
          <?php endif; ?>
        </div>
        <!-- content-right comment section -->
        <div class="ad">
          <img src="<?= BASE_URL ?>/public/images/ad.jpg" alt="Ad for VT master's degree" width="40%" />
          <img src="<?= BASE_URL ?>/public/images/ad.jpg" alt="Ad for VT master's degree" width="40%" />
          <!-- source: https://pbs.twimg.com/profile_images/1004769023500824576/q9c1EJ-w_400x400.jpg -->
        </div>
        <!-- .ad -->
      </div>
      <!-- .content-right -->
    </div>