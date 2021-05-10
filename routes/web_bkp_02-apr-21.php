<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', 'AuthController@login')->name('login');


/* Admin Route Start */
Route::get('login', 'AuthController@login')->name('login');
Route::post('login', 'AuthController@loginPost')->name('login.post');
Route::post('forgot', 'AuthController@forgotPost')->name('forgot.post');
Route::get('forgot-password/{id}', 'AuthController@forgotPassword')->name('forgot-password');
Route::post('forgot-password/{token}', 'AuthController@forgotPostPassword')->name('forgot-password.post');
//Route::prefix('admin')->middleware('auth','isAdmin')->name('admin.')->group(function() {

    Route::get('dashboard/', 'DashboardController@index')->name('dashboard')->middleware('auth');
    Route::get('/logout', 'AuthController@logout')->name('logout')->middleware('auth');
    Route::prefix('users')->middleware('auth')->name('users.')->group(static function() {
        Route::get('/', 'AdminManagementController@index')->name('index');
        Route::get('/edit/{id}', 'AdminManagementController@getEdit')->name('edit');
        Route::post('/edit/{id}', 'AdminManagementController@postEdit')->name('edit.post');
        Route::get('/change-password/{id}', 'AdminManagementController@changePassword')->name('change-password');
        Route::post('/change-password/{id}', 'AdminManagementController@changePasswordUpdate')->name('change-password.post');
		Route::get('/profile-change/{id}', 'AdminManagementController@changeProfile')->name('profile-change');
		 Route::post('/profile-change/{id}', 'AdminManagementController@changeProfileUpdate')->name('profile-change.post');
         Route::get('/reset-password/{id}', 'AdminManagementController@resetPassword')->name('reset-password');
         Route::post('/reset-password/{id}', 'AdminManagementController@resetPasswordUpdate')->name('reset-password.post');
		

        Route::get('/remove/{id}', 'AdminManagementController@remove')->name('remove');
        Route::get('/add', 'AdminManagementController@add')->name('add');
        Route::post('/add', 'AdminManagementController@addPost')->name('add.post');
        
    });
	Route::prefix('/projects')->middleware('auth')->name('projects.')->group(static function() {
        Route::get('/', 'ProjectController@index')->name('index');
		Route::get('/edit/{id}', 'ProjectController@getEdit')->name('edit');
        Route::post('/edit/{id}', 'ProjectController@postEdit')->name('edit.post');
		Route::get('/view/{id}', 'ProjectController@getProjectView')->name('view');
        Route::get('/remove/{id}', 'ProjectController@remove')->name('remove');
        Route::get('/add', 'ProjectController@add')->name('add');
        Route::post('/add', 'ProjectController@addPost')->name('add.post');
		Route::get('/viewurl/{id}', 'ProjectController@getProjectUrl')->name('viewurl');
		Route::get('/addkeyword/{id}', 'ProjectController@addkeyword')->name('addkeyword');
		Route::post('/addkeyword', 'ProjectController@addKeywordPost')->name('addkeyword.post');
		Route::get('/managekeyword/{id}', 'ProjectController@managekeyword')->name('managekeyword');
		Route::post('/managekeyword', 'ProjectController@manageKeywordPost')->name('managekeyword.post');
		Route::get('keyword/remove/{id}', 'ProjectController@removeUrlKeyword')->name('keyword.remove');
		Route::get('/job/edit/{id}', 'ProjectController@getJobEdit')->name('job.edit');
		Route::get('/job/view/{id}', 'ProjectController@getJobView')->name('job.view');
		Route::get('/job/csv/download/{id}', 'ProjectController@getJobCsvDownload')->name('job.csv.download');
        Route::post('/job/edit/{id}', 'ProjectController@jobPostEdit')->name('job.edit.post');
		Route::post('/projecturl/brand/keyword/list', 'ProjectController@getProjectUrlBrandKeywordList')->name('projecturl.brandkeyword.list');
		Route::post('/projecturl/secondary/keyword/list', 'ProjectController@getProjectUrlSecondaryKeywordList')->name('projecturl.secondarykeyword.list');
		
    });
	Route::prefix('/jobs')->middleware('auth')->name('jobs.')->group(static function() {
        Route::get('/', 'JobController@index')->name('index'); 
		Route::get('/add', 'JobController@add')->name('add');
		Route::get('/edit/{id}', 'JobController@getEdit')->name('edit');
		Route::get('/remove/{id}', 'JobController@remove')->name('remove');
		Route::get('/view/{id}', 'JobController@getView')->name('view');
		Route::get('/csv/download/{id}', 'JobController@getCsvDownload')->name('csv.download');
        Route::post('/edit/{id}', 'JobController@postEdit')->name('edit.post');
		Route::post('/add', 'JobController@addPost')->name('add.post');
		Route::post('/projecturllist', 'JobController@getProjectUrlList')->name('projecturl.list');
		Route::post('/projecturllistdata', 'JobController@getProjectUrlListData')->name('projecturldata.list');
     });


Route::prefix('/api/v1')->name('api.v1.')->group(static function() {
   Route::get('/access-token','Api\ApiController@getAccessToken')->name('access-token');
   Route::post('/access-token','Api\ApiController@postAccessToken')->name('access-token.post');
   Route::get('/get-crawler/{id}','Api\ApiController@uploadCsvFileForCrawler')->name('get-crawler');
   Route::get('/report-crawler/{id}','Api\ApiController@getReportCrawler')->name('report-crawler');
   Route::post('/report-crawler','Api\ApiController@postReportCrawler')->name('report-crawler');
   Route::post('/post-crawler/{id}','Api\ApiController@uploadCsvFileForCrawler')->name('post-crawler');
   Route::post('/crawler/{id}','Api\ApiController@submitCrawlerJob')->name('crawler.post');
   Route::get('/crawler-job','Api\ApiController@crawlerJob')->name('crawler-job');
   Route::get('/project-list','Api\ApiController@projectList')->name('project.list');
   Route::get('/project-url-list/{id}','Api\ApiController@projectUrlList')->name('project.url.list');
});

/* Admin Route End */
/* Admin User Route Start */

// Route::get('admin-user/login', 'subAdmin\AuthController@login')->name('admin-user.login');
// Route::post('admin-user/login', 'subAdmin\AuthController@loginPost')->name('admin-user.login.post');
// Route::prefix('admin-user')->middleware('adminUser')->name('admin-user.')->group(function() {
    // Route::get('/', 'subAdmin\DashboardController@index')->name('dashboard');
    // Route::get('/logout', 'subAdmin\AuthController@logout')->name('logout');
    // Route::prefix('/project')->name('project.')->group(static function() {
        // Route::get('/', 'subAdmin\ProjectController@index')->name('index');
		// Route::get('/edit/{id}', 'subAdmin\ProjectController@getEdit')->name('edit');
        // Route::post('/edit/{id}', 'subAdmin\ProjectController@postEdit')->name('edit.post');
		// Route::get('/view/{id}', 'subAdmin\ProjectController@getProjectView')->name('view');
        // Route::get('/remove/{id}', 'subAdmin\ProjectController@remove')->name('remove');
        // Route::get('/add', 'subAdmin\ProjectController@add')->name('add');
        // Route::post('/add', 'subAdmin\ProjectController@addPost')->name('add.post');
		// Route::get('/viewurl/{id}', 'subAdmin\ProjectController@getProjectUrl')->name('viewurl');
		// Route::get('/addkeyword/{id}', 'subAdmin\ProjectController@addkeyword')->name('addkeyword');
		// Route::post('/addkeyword', 'subAdmin\ProjectController@addKeywordPost')->name('addkeyword.post');
		// Route::get('keyword/remove/{id}', 'subAdmin\ProjectController@removeUrlKeyword')->name('keyword.remove');
    // });
    // Route::prefix('/job')->name('job.')->group(static function() {
        // Route::get('/', 'subAdmin\JobController@index')->name('index'); 
		  // Route::get('/add', 'subAdmin\JobController@add')->name('add');
    // });
// });

/* Admin User Route End */
