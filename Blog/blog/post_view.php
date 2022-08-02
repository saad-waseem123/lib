<?php $this->extend("frontend/layouts/app"); ?>
Done
<?php $this->section("head"); ?>
<title>Saif Ecom</title>
<link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
<?php $this->endSection(); ?>

<?php $this->section("content"); ?>
<main class="main pb-10 pt-10">
  <!-- Start of Page Content -->
  <div class="page-content">
    <div class="container">

      <div class="row gutter-lg">
        <div class="main-content">
          <?php foreach ($formData as $data) : ?>
            <article class="post post-list post-listing mb-md-10 mb-6 pb-2 overlay-zoom mb-4">
              <figure class="post-media br-sm">
                <a href="<?= site_url(route_to('frontend_single_post', $data['post_slug'])) ?>">
                  <img src="<?= site_url('uploads/posts/') ?><?= ($data['post_img']) ? $data['post_img'] : 'placeholder.png' ?>" width="930" height="500" alt="blog">
                </a>
              </figure>
              <div class="post-details">
                <div class="post-cats text-primary">
                  <a href="#">
                
               <?= $data['pcat_name']?>
                  </a>
                </div>
                <h4 class="post-title">
                  <a href="<?= site_url(route_to('frontend_single_post', $data['post_slug'])) ?>"><?= $data['post_name'] ?></a>
                </h4>
                <div class="post-content">
                  <p><?= $data['post_desc'] ?>…</p>
                  <a href="<?= site_url(route_to('frontend_single_post', $data['post_slug'])) ?>" class="btn btn-link btn-primary">(read more)</a>
                </div>
                <div class="post-meta">
                  by <a href="#" class="post-author"><?= $admin['first_name'] . "  " . $admin['last_name'] ?></a>
                  - <div href="" class="post-date">
                    <?php
                    echo date("jS F, Y", strtotime( $data['created_at']));
                    // outputs 10th December, 2011
                    ?>
                  </div>
                </div>
              </div>
            </article>
          <?php endforeach; ?>


          <?= $pager->links('custom', 'custom_full') ?>

        </div>
        <!-- End of Main Content -->
        <aside class="sidebar right-sidebar blog-sidebar sidebar-fixed sticky-sidebar-wrapper">
          <div class="sidebar-overlay">
            <a href="#" class="sidebar-close">
              <i class="close-icon"></i>
            </a>
          </div>
          <a href="#" class="sidebar-toggle">
            <i class="fas fa-chevron-left"></i>
          </a>
          <div class="sidebar-content">
            <div class="pin-wrapper" style="height: 1489.56px;">
              <div class="sticky-sidebar" style="border-bottom: 0px none rgb(102, 102, 102); width: 280px;">

                <!-- End of Widget search form -->
                <div class="widget widget-categories">
                  <h3 class="widget-title bb-no mb-0">Post Categories</h3>
                  <ul class="widget-body filter-items search-ul">
                    <?php foreach ($categories as $category) : ?>
                      <li><a href="<?= site_url(route_to('frontend_category', $category['pcat_slug'])) ?>"><?= $category['pcat_name'] ?></a></li>
                    <?php endforeach; ?>


                  </ul>
                </div>

                <!-- End of Widget categories -->
                <div class="widget widget-posts">
                  <h3 class="widget-title bb-no">Popular Posts</h3>
                  <div class="widget-body">
                    <div class="swiper">
                      <div class="swiper-container swiper-theme nav-top swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events" data-swiper-options="{ 'spaceBetween': 20, 'slidesPerView': 1 }">
                        <div class="swiper-wrapper " id="swiper-wrapper-74f5276e821b101f8" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">
                          <div class="swiper-slide widget-col swiper-slide-active" role="group" aria-label="1 / 1" style="width: 280px; margin-right: 20px;">

                            <?php foreach ($posts as $post) : ?>
                              <div class="post-widget mb-4">
                                <figure class="post-media br-sm">
                                  <img src="<?= site_url('uploads/posts/') ?><?= ($post['post_img']) ? $post['post_img'] : 'placeholder.png' ?>" alt="150" height="110">
                                </figure>
                                <div class="post-details">
                                  <div class="post-meta">
                                    <a href="#" class="post-date">March 1, 2021</a>
                                  </div>
                                  <h4 class="post-title">
                                    <a href="post-single.html"><?= $post['post_name'] ?></a>
                                  </h4>
                                </div>
                              </div>

                          </div>
                        <?php endforeach; ?>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="widget widget-tags">
                  <h3 class="widget-title bb-no">Browse Tags</h3>
                  <div class="widget-body tags">
                    <a href="#" class="tag">Fashion</a>
                    <a href="#" class="tag">Style</a>
                    <a href="#" class="tag">Travel</a>
                    <a href="#" class="tag">Women</a>
                    <a href="#" class="tag">Men</a>
                    <a href="#" class="tag">Hobbies</a>
                    <a href="#" class="tag">Shopping</a>
                    <a href="#" class="tag">Photography</a>
                  </div>
                </div>
              </div>
            </div>
        </aside>
      </div>



    </div>
  </div>
  <!-- End of Page Content -->
</main>
<?php $this->endSection(); ?>

<?php $this->section("footer"); ?>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<?php $this->endSection(); ?>