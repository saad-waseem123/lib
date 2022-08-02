<?php echo $this->extend('layouts/frontend_app_view') ?>

<?php echo $this->section('head_meta') ?>
  <title>Services | <?php echo WEBSITE_TITLE; ?></title>
  <!-- Write Here For SEO -->
<?php echo $this->endSection() ?>

<?php echo $this->section('styles') ?>
  <!-- Write here page spacific styles -->
    <style>
	.page-title { background-image: url(<?php echo FRONT_ASSETS; ?>assets/images/page-title.jpg) ; }
.page-wrap {
	padding: 50px 0 !important;
	background-color: #fff;
	overflow: hidden;
}
</style>
<?php echo $this->endSection() ?>
<?php echo $this->section('content') ?>
 <!-- Page title -->
      <div class="page-title pagetitle_style_2">
        <div class="overlay"></div>
        <div class="container">
          <div class="row">
			  <div class="col-md-12 page-title-container">
              <div class="page-title-heading">
                <h1 class="title">Services</h1>
              </div>
              <!-- /.page-title-captions --> 
              <div class="breadcrumb-trail breadcrumbs">
                <span class="trail-browse"></span> <span class="trail-begin"><a href="<?php echo base_url('') ?>" rel="home">Home</a></span>
                <span class="sep">></span> <span class="trail-end">Services</span>
              </div>
            </div>
            <!-- /.col-md-12 -->  
          </div>
          <!-- /.row -->  
        </div>
        <!-- /.container -->                      
      </div>
      <!-- /.page-title --> 	
      <div id="content" class="page-wrap sidebar-right">
        <div class="container content-wrapper">
          <div class="row">
            <div class="col-md-12">
              <div id="primary" class="content-area-full-width">
                <main id="main" class="site-main" role="main">
                  <div class="vc_row wpb_row vc_row-fluid vc_custom_1489221853718">
                    <div class="wpb_column vc_column_container vc_col-sm-12">
                      <div class="vc_column-inner">
                        <div class="wpb_wrapper">
                          <div class="vc_row wpb_row vc_inner vc_row-fluid">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                              <div class="vc_column-inner">
                                <div class="wpb_wrapper">
                                  <div class="title-section  style3">
                                    <h1 class="title">
                                      What We Can Offer You			
                                    </h1>
                                    <div class="title-content">
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor<br />
                                        incididunt ut labore et dolore magna aliqua.
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="vc_empty_space"   style="height: 40px"><span class="vc_empty_space_inner"></span></div>
                          <div class="vc_row wpb_row vc_inner vc_row-fluid">
                            <?php foreach($pageData as $row): ?>
                            <div class="wpb_column vc_column_container vc_col-sm-4">
                              <div class="vc_column-inner">
                                <div class="wpb_wrapper">
                                  <div class="flat-imagebox services-grid ">
                                    <div class="flat-imagebox-inner">
                                      <div class="flat-imagebox-image">
                                        <img class="" src="<?php echo FRONT_ASSETS; ?>assets/images/<?php echo $row['img']?>" width="370" height="240" alt="b7" title="b7" />				
                                      </div>
                                      <div class="flat-imagebox-header">
                                        <h3 class="flat-imagebox-title">
                                          <a href="<?php echo base_url('services/business-solutions') ?>" target="_blank">
                                          <?php echo $row['title']?></a>	
                                        </h3>
                                      </div>
                                      <div class="flat-imagebox-content">
                                        <div class="flat-imagebox-desc">
                                            <?php echo $row['excerpt']?>					
                                        </div>
                                        <div class="flat-imagebox-button">
                                          <a href="<?php echo base_url('services/'.$row['slug']) ?>" target="_blank">
                                          Read More						</a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                <?php endforeach;?>
                        </div>
                          <!-- <div class="vc_empty_space"   style="height: 60px"><span class="vc_empty_space_inner"></span></div> -->
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </main>
                <!-- #main -->
              </div>
              <!-- #primary -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container -->
      </div>
      <!-- #content -->


<?php echo $this->endSection() ?>

<?php echo $this->section('scripts') ?>
  <!-- Write here page spacific js scripts -->
<?php echo $this->endSection() ?>