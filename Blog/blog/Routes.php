<?php
Done
namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('FrontendController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'FrontendController::index', ['as' => 'frontend_home']);

$routes->get('login', 'AuthController::index', ['as' => 'login', 'filter' => 'guest']);
$routes->post('login', 'AuthController::login', ['as' => 'login', 'filter' => 'guest']);
$routes->get('forgot-password', 'AuthController::forgot_password', ['as' => 'forgot_password', 'filter' => 'guest']);
$routes->post('sent-password-reset-link', 'AuthController::sent_password_reset_link', ['as' => 'sent_password_reset_link', 'filter' => 'guest']);
$routes->get('password-reset', 'AuthController::password_reset_view', ['as' => 'password-reset', 'filter' => 'guest']);
$routes->post('password-reset', 'AuthController::password_reset', ['as' => 'password-reset', 'filter' => 'guest']);
$routes->get('signup', 'AuthController::signup', ['as' => 'signup', 'filter' => 'guest']);
$routes->post('user/create', 'AuthController::signup_create', ['as' => 'signup-create', 'filter' => 'guest']);
$routes->get('verify/(:any)', 'AuthController::verify/$1', ['as' => 'verify_account','filter' => 'guest']);
$routes->get('logout', 'AuthController::logout', ['as' => 'logout']);

$routes->get('about-us', 'FrontendController::about_us', ['as' => 'frontend_about_us']);
$routes->get('contact-us', 'FrontendController::contact_us', ['as' => 'frontend_contact_us']);
$routes->get('terms_and_condition', 'FrontendController::terms_and_condition', ['as' => 'frontend_terms_and_condition']);
$routes->get('category/(:any)', 'CategoryController::index/$1', ['as' => 'frontend_category']);
$routes->get('products', 'ProductController::index', ['as' => 'frontend_products']);
$routes->get('product/(:any)', 'ProductController::show/$1', ['as' => 'frontend_single_product']);
$routes->get('blog', 'BlogController::index', ['as' => 'frontend_blog']);
$routes->get('blog/(:any)', 'BlogController::single_post/$1', ['as' => 'frontend_single_post']);


$routes->group('dashboard', ['filter' => 'auth'], function ($routes) {
    // Dashboard
    $routes->get('/', 'Backend\DashboardController::index', ['as' => 'backend_dashboard']);
    
    // Permission
    $routes->get('permissions', 'Backend\PermissionController::index', ['as' => 'backend_permissions', 'filter' => 'has-access:permission_view']);
    
    // Roles
    $routes->group('roles', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'Backend\RoleController::index', ['as' => 'backend_roles', 'filter' => 'has-access:role_view']);
        $routes->get('new', 'Backend\RoleController::new', ['as' => 'backend_role_new', 'filter' => 'has-access:role_create']);
        $routes->post('create', 'Backend\RoleController::create', ['as' => 'backend_role_create', 'filter' => 'has-access:role_create']);
        $routes->get('edit/(:num)', 'Backend\RoleController::edit/$1', ['as' => 'backend_role_edit', 'filter' => 'has-access:role_create']);
        $routes->post('update/(:num)', 'Backend\RoleController::update/$1', ['as' => 'backend_role_update', 'filter' => 'has-access:role_edit']);
        $routes->get('delete/(:num)', 'Backend\RoleController::delete/$1', ['as' => 'backend_role_delete', 'filter' => 'has-access:role_delete']);
    });

    // User Start
    $routes->group('users', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'Backend\UserController::index', ['as' => 'backend_users', 'filter' => 'has-access:user_view']);
        $routes->get('new', 'Backend\UserController::new', ['as' => 'backend_user_new', 'filter' => 'has-access:user_create']);
        $routes->post('create', 'Backend\UserController::create', ['as' => 'backend_user_create', 'filter' => 'has-access:user_create']);
        $routes->get('edit/(:num)', 'Backend\UserController::edit/$1', ['as' => 'backend_user_edit', 'filter' => 'has-access:user_edit']);
        $routes->post('update/(:num)', 'Backend\UserController::update/$1', ['as' => 'backend_user_update', 'filter' => 'has-access:user_edit']);
        $routes->get('delete/(:num)', 'Backend\UserController::delete/$1', ['as' => 'backend_user_delete', 'filter' => 'has-access:user_delete']);
    });

    // Profile Start
    $routes->group('profile', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'Backend\ProfileController::index', ['as' => 'backend_profile']);
        $routes->post('update', 'Backend\ProfileController::update', ['as' => 'backend-profile-update']);
        $routes->post('update/image', 'Backend\ProfileController::update_image', ['as' => 'backend-profile-image-update']);
        $routes->post('update/password', 'AuthController::backend_update_password', ['as' => 'backend-password-update']);
    });

    // Site Setting Start Junck Code
    $routes->match(['get', 'post'], 'settings', 'Backend\SiteSettingController::settings', ['as' => 'backend_settings', 'filter' => 'has-access:settings']);

    // Slider
    $routes->group('slider', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'Backend\SliderController::index', ['as' => 'backend_sliders', 'filter' => 'has-access:slider_view']);
        $routes->get('new', 'Backend\SliderController::new', ['as' => 'backend_slider_new', 'filter' => 'has-access:slider_create']);
        $routes->post('create', 'Backend\SliderController::create', ['as' => 'backend_slider_create', 'filter' => 'has-access:slider_create']);
    });

    // Slide    
    $routes->group('slide', ['filter' => 'auth'], function ($routes) {
        $routes->get('(:num)', 'Backend\SlideController::index/$1', ['as' => 'backend_slides', 'filter' => 'has-access:slider_view']);
        $routes->get('(:num)/new', 'Backend\SlideController::new/$1', ['as' => 'backend_slide_new', 'filter' => 'has-access:slider_create']);
        $routes->post('(:num)/create', 'Backend\SlideController::create/$1', ['as' => 'backend_slide_create', 'filter' => 'has-access:slider_create']);
    });

    $routes->group('category', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'Backend\CategoryController::index', ['as' => 'backend_categories', 'filter' => 'has-access:category_view']);
        $routes->post('create', 'Backend\CategoryController::create', ['as' => 'backend_category_create', 'filter' => 'has-access:category_create']);
        $routes->get('delete/(:num)', 'Backend\CategoryController::delete/$1', ['as' => 'backend_user_delete', 'filter' => 'has-access:category_create']);
        $routes->add('ajax/edit', 'Backend\CategoryController::ajax_edit', ['as' => 'backend_ajax_category_edit', 'filter' => 'has-access:category_edit']);
        $routes->post('update', 'Backend\CategoryController::update', ['as' => 'backend_category_update', 'filter' => 'has-access:category_edit']);
        $routes->delete('delete', 'Backend\CategoryController::delete', ['as' => 'backend_category_delete', 'filter' => 'has-access:category_delete']);
    });


    $routes->group('postcategory', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'Backend\PostCategoryController::index', ['as' => 'backend_postcategories', 'filter' => 'has-access:category_view']);
        $routes->post('create', 'Backend\PostCategoryController::create', ['as' => 'backend_postcategory_create', 'filter' => 'has-access:postcategory_create']);
        $routes->get('delete/(:num)', 'Backend\PostCategoryController::delete/$1', ['as' => 'backend_user_delete', 'filter' => 'has-access:postcategory_create']);
        $routes->add('ajax/edit', 'Backend\PostCategoryController::ajax_edit', ['as' => 'backend_ajax_postcategory_edit', 'filter' => 'has-access:postcategory_edit']);
        $routes->post('update', 'Backend\PostCategoryController::update', ['as' => 'backend_postcategory_update', 'filter' => 'has-access:postcategory_edit']);
        $routes->delete('delete', 'Backend\PostCategoryController::delete', ['as' => 'backend_postcategory_delete', 'filter' => 'has-access:postcategory_delete']);
    });



    $routes->group('product', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'Backend\ProductController::index', ['as' => 'backend_products', 'filter' => 'has-access:product_view']);
        $routes->get('new', 'Backend\ProductController::new', ['as' => 'backend_product_new', 'filter' => 'has-access:product_create']);
        $routes->post('create', 'Backend\ProductController::create', ['as' => 'backend_product_create', 'filter' => 'has-access:product_create']);
        $routes->get('edit/(:num)', 'Backend\ProductController::edit/$1', ['as' => 'backend_product_edit', 'filter' => 'has-access:product_edit']);
        $routes->post('update/(:num)', 'Backend\ProductController::update/$1', ['as' => 'backend_product_update', 'filter' => 'has-access:product_edit']);
        $routes->get('delete/(:num)', 'Backend\ProductController::delete/$1', ['as' => 'backend_product_delete', 'filter' => 'has-access:product_delete']);
        // 
        $routes->get('export', 'Backend\ProductController::export', ['as' => 'backend_product_export']);
        $routes->get('import', 'Backend\ProductController::import', ['as' => 'backend_product_import']);
        $routes->post('upload', 'Backend\ProductController::upload', ['as' => 'backend_product_upload']);
        
    });

    $routes->group('reviews', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'Backend\ReviewController::index', ['as' => 'backend_reviews', 'filter' => 'has-access:product_view']);
        $routes->get('new', 'Backend\ReviewController::new', ['as' => 'backend_review_new', 'filter' => 'has-access:product_create']);
        $routes->post('create', 'Backend\ReviewController::create', ['as' => 'backend_review_create', 'filter' => 'has-access:product_create']);
        $routes->get('edit/(:num)', 'Backend\ReviewController::edit/$1', ['as' => 'backend_review_edit', 'filter' => 'has-access:product_edit']);
        $routes->post('update/(:num)', 'Backend\ReviewController::update/$1', ['as' => 'backend_review_update', 'filter' => 'has-access:product_edit']);
        $routes->get('delete/(:num)', 'Backend\ReviewController::delete/$1', ['as' => 'backend_review_delete', 'filter' => 'has-access:product_delete']);
    });

    $routes->group('post', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'Backend\PostController::index', ['as' => 'backend_posts', 'filter' => 'has-access:post_view']);
        $routes->get('new', 'Backend\PostController::new', ['as' => 'backend_post_new', 'filter' => 'has-access:post_create']);
        $routes->post('create', 'Backend\PostController::create', ['as' => 'backend_post_create', 'filter' => 'has-access:post_create']);
        $routes->get('edit/(:num)', 'Backend\PostController::edit/$1', ['as' => 'backend_post_edit', 'filter' => 'has-access:post_edit']);
        $routes->post('update/(:num)', 'Backend\PostController::update/$1', ['as' => 'backend_post_update', 'filter' => 'has-access:post_edit']);
        $routes->get('delete/(:num)', 'Backend\PostController::delete/$1', ['as' => 'backend_post_delete', 'filter' => 'has-access:post_delete']);
        
    });
    
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
