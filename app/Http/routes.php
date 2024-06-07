<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

Route::get('admin', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::resource('category', 'CategoryController');

Route::resource('subcategory', 'SubCategoryController');

Route::resource('source', 'SourceController');

Route::resource('sourcequoted', 'SourceQuotedController');

Route::resource('summary', 'SummaryController');

//Public access routes
Route::get('/', 'PublicController@index');
Route::get('open', 'PublicController@index');
Route::get('publicstandard', 'PublicController@standard');
Route::get('categories', 'PublicController@categories');
Route::get('eras', 'PublicController@eras');
Route::get('sources', 'PublicController@sources');
Route::get('background', 'PublicController@background');
Route::get('beliefs', 'PublicController@beliefs');
Route::get('search', 'PublicController@topical');
Route::get('explore', 'PublicController@explore');
Route::get('contact', 'PublicController@contact');
Route::get('locations', 'PublicController@locations');
Route::get('sacrifices', 'PublicController@sacrifices');
Route::get('lifestylesofjesustime', 'PublicController@lifestyles');
Route::get('oldandnewtestamenttimes', 'PublicController@oldandnew');
Route::get('storiesaboutjesus', 'PublicController@stories');
Route::get('aboutdatabase', 'PublicController@aboutdatabase');

Route::controller('/open', 'PublicController', [
    'getPublicSubCategories' => 'getpublicsubcategories',
    'getPublicSources' => 'getpublicsources',
    'getPublicEras' => 'getpubliceras',
    'getPublicStandard' => 'getpublicstandard'
]);

Route::post('contact', 'EnquiryController@index');

//Route::controller('datatables', 'DatatablesController', [
//    'anyData'  => 'datatables.data',
//    'getIndex' => 'datatables',
//]);
Route::get('category', 'CategoryController@index');
Route::controller('categories', 'CategoryController', [
    'getCategories' => 'categories',
    'getSubcategories' => 'subcategories',
    'postUpdateCategory' => 'updatecategory',
    'postDeleteCategory' => 'deletecategory',
	'postUpdateSubcategory' => 'updatesubcategory',
	'postDeleteSubcategory' => 'deletesubcategory',
//    'getPublicCategories' => 'getpubliccategories'
]);

//Route::controller('subcategories', 'SubCategoryController', [
////	'getSubcategories' => 'subcategories',
////	'postUpdateSubcategory' => 'updatesubcategory',
////	'postDeleteSubcategory' => 'deletesubcategory'
//]);

Route::controller('summaries', 'SummaryController', [
	'getSummaries' => 'summaries',
	'postUpdateSummary' => 'updatesummary',
	'postDeleteSummary' => 'deletesummary'
]);

Route::controller('sources', 'SourceController', [
    'getSources' => 'sources',
	'postUpdateSource' => 'updatesource',
	'postDeleteSource' => 'deletesource',
	'getStatusTypes' => 'statustypes',
	'getPublishers' => 'publishers',
	'getSourceTypes' => 'sourcetypes',
	'getSourceDetails' => 'source_details',
	'postEditSourceDetail' => 'editsource_detail',
	'postDeleteSourceDetail' => 'deletesource_detail',
	'postAddSourceDetail' => 'addsource_detail',
]);

//Quotation
Route::get('quotation', 'QuotationController@index');
Route::controller('quotations', 'QuotationController', [
    'getQuotation' => 'quotations',
    'getStatusTypes' => 'status_types',
    'postUpdateQuotation' => 'update_quotation',
    'postDeleteQuotation' => 'delete_quotation'
]);

Route::controller('sourcesquoted', 'SourceQuotedController', [
    'getSourceQuoted' => 'sourcesquoted',
    'postUpdateSourceQuoted' => 'updatesourcequoted',
	'postDeleteSourceQuoted' => 'deletesourcequoted',
	'getSources' => 'getsources_quoted'
]);

//Era
Route::get('era', 'EraController@index');
Route::controller('eras', 'EraController',[
    'getEras' => 'eras',
    'getEraYears' => 'era_years',
    'postUpdateEra' => 'update_era',
    'postDeleteEra' => 'delete_era'
]);

//Source Type
Route::get('sourcetype', 'SourceTypeController@index');
Route::controller('sourcttypes', 'SourceTypeController',[
    'getSourceTypes' => 'source_types',
    'postUpdateSourceType' => 'update_source_type',
    'postDeleteSourceType' => 'delete_source_type'
]);

Route::get('erayear', 'EraYearController@index');
Route::controller('erayears', 'EraYearController',[
    'getEraYears' => 'erayears',
    'postUpdateEraYear' => 'update_era_year',
    'postDeleteEraYear' => 'delete_era_year'
]);

Route::get('standard', 'SummaryDetailsController@index');
Route::controller('summary_details', 'SummaryDetailsController',[
    'getSummaryDetails' => 'summary_details',
    'getEras' => 'eras_for_combobox',
    'getCategories' =>'category_for_combobox',
    'getSubcategories' =>'subcategory_for_combobox',
    'getSummaryOptions' => 'summaries_for_input',
    'getCategoryOptions' => 'categories_for_input',
    'getEraOptions' => 'eras_for_input',
    'getSourceOptions' => 'sources_for_input',
    'getSourceQuotedOptions' => 'source_quoted_for_input',
    'getQuotationOptions' => 'quotations_for_input',
    'postUpdateSummaryDetails' => 'update_details',
    'postDeleteSummaryDetails' => 'delete_details',
    'getAddSummaryDetails' => 'add_details',
    'getAddEra' => 'add_era'
]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
    'home' => 'HomeController',
]);
