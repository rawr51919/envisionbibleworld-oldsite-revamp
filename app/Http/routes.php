<?php

use Illuminate\Support\Facades\Route;
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

Route::get('welcome', 'WelcomeController@index');

Route::get('welcome-legacy', 'LegacyWelcomeController@index');

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

Route::get('/open', 'PublicController@index')->name('open');
Route::get('/open/subcategories', 'PublicController@getPublicSubCategories')->name('getpublicsubcategories');
Route::get('/open/sources', 'PublicController@getPublicSources')->name('getpublicsources');
Route::get('/open/eras', 'PublicController@getPublicEras')->name('getpubliceras');
Route::get('/open/standard', 'PublicController@getPublicStandard')->name('getpublicstandard');

Route::post('contact', 'EnquiryController@index');

Route::get('datatables', 'DatatablesController@anyData')->name('datatables.data');
Route::get('datatables', 'DatatablesController@getIndex')->name('datatables');

Route::get('category', 'CategoryController@index');
Route::get('categories', 'CategoryController@getCategories')->name('categories');
Route::get('categories/subcategories', 'CategoryController@getSubcategories')->name('subcategories');
Route::post('categories/update', 'CategoryController@postUpdateCategory')->name('updatecategory');
Route::post('categories/delete', 'CategoryController@postDeleteCategory')->name('deletecategory');
Route::post('categories/subcategories/update', 'CategoryController@postUpdateSubcategory')->name('updatesubcategory');
Route::post('categories/subcategories/delete', 'CategoryController@postDeleteSubcategory')->name('deletesubcategory');
Route::get('categories/public', 'CategoryController@getPublicCategories')->name('getpubliccategories');

Route::get('subcategories', 'SubCategoryController@getSubcategories')->name('subcategories');
Route::post('subcategories/update', 'SubCategoryController@postUpdateSubcategory')->name('updatesubcategory');
Route::post('subcategories/delete', 'SubCategoryController@postDeleteSubcategory')->name('deletesubcategory');

Route::get('summaries', 'SummaryController@getSummaries')->name('summaries');
Route::post('summaries/update', 'SummaryController@postUpdateSummary')->name('updatesummary');
Route::post('summaries/delete', 'SummaryController@postDeleteSummary')->name('deletesummary');

Route::get('sources', 'SourceController@getSources')->name('sources');
Route::post('sources/update', 'SourceController@postUpdateSource')->name('updatesource');
Route::post('sources/delete', 'SourceController@postDeleteSource')->name('deletesource');
Route::get('sources/status-types', 'SourceController@getStatusTypes')->name('statustypes');
Route::get('sources/publishers', 'SourceController@getPublishers')->name('publishers');
Route::get('sources/source-types', 'SourceController@getSourceTypes')->name('sourcetypes');
Route::get('sources/details', 'SourceController@getSourceDetails')->name('source_details');
Route::post('sources/details/edit', 'SourceController@postEditSourceDetail')->name('editsource_detail');
Route::post('sources/details/delete', 'SourceController@postDeleteSourceDetail')->name('deletesource_detail');
Route::post('sources/details/add', 'SourceController@postAddSourceDetail')->name('addsource_detail');


//Quotation
Route::get('quotation', 'QuotationController@index');
Route::get('quotations', 'QuotationController@getQuotation')->name('quotations');
Route::get('quotations/status-types', 'QuotationController@getStatusTypes')->name('status_types');
Route::post('quotations/update', 'QuotationController@postUpdateQuotation')->name('update_quotation');
Route::post('quotations/delete', 'QuotationController@postDeleteQuotation')->name('delete_quotation');


Route::get('sourcesquoted', 'SourceQuotedController@getSourceQuoted')->name('sourcesquoted');
Route::post('sourcesquoted/update', 'SourceQuotedController@postUpdateSourceQuoted')->name('updatesourcequoted');
Route::post('sourcesquoted/delete', 'SourceQuotedController@postDeleteSourceQuoted')->name('deletesourcequoted');
Route::get('sourcesquoted/sources', 'SourceQuotedController@getSources')->name('getsources_quoted');


//Era
Route::get('era', 'EraController@index');
Route::get('eras', 'EraController@getEras')->name('eras');
Route::get('eras/years', 'EraController@getEraYears')->name('era_years');
Route::post('eras/update', 'EraController@postUpdateEra')->name('update_era');
Route::post('eras/delete', 'EraController@postDeleteEra')->name('delete_era');


//Source Type
Route::get('sourcetype', 'SourceTypeController@index');
Route::get('sourcetypes', 'SourceTypeController@getSourceTypes')->name('source_types');
Route::post('sourcetypes/update', 'SourceTypeController@postUpdateSourceType')->name('update_source_type');
Route::post('sourcetypes/delete', 'SourceTypeController@postDeleteSourceType')->name('delete_source_type');

Route::get('erayear', 'EraYearController@index');
Route::get('erayears', 'EraYearController@getEraYears')->name('erayears');
Route::post('erayears/update', 'EraYearController@postUpdateEraYear')->name('update_era_year');
Route::post('erayears/delete', 'EraYearController@postDeleteEraYear')->name('delete_era_year');


Route::get('standard', 'SummaryDetailsController@index');
Route::get('summary_details', 'SummaryDetailsController@getSummaryDetails')->name('summary_details');
Route::get('summary_details/eras-for-combobox', 'SummaryDetailsController@getEras')->name('eras_for_combobox');
Route::get('summary_details/categories-for-combobox', 'SummaryDetailsController@getCategories')->name('category_for_combobox');
Route::get('summary_details/subcategories-for-combobox', 'SummaryDetailsController@getSubcategories')->name('subcategory_for_combobox');
Route::get('summary_details/summaries-for-input', 'SummaryDetailsController@getSummaryOptions')->name('summaries_for_input');
Route::get('summary_details/categories-for-input', 'SummaryDetailsController@getCategoryOptions')->name('categories_for_input');
Route::get('summary_details/eras-for-input', 'SummaryDetailsController@getEraOptions')->name('eras_for_input');
Route::get('summary_details/sources-for-input', 'SummaryDetailsController@getSourceOptions')->name('sources_for_input');
Route::get('summary_details/sources-quoted-for-input', 'SummaryDetailsController@getSourceQuotedOptions')->name('source_quoted_for_input');
Route::get('summary_details/quotations-for-input', 'SummaryDetailsController@getQuotationOptions')->name('quotations_for_input');
Route::post('summary_details/update', 'SummaryDetailsController@postUpdateSummaryDetails')->name('update_details');
Route::post('summary_details/delete', 'SummaryDetailsController@postDeleteSummaryDetails')->name('delete_details');
Route::get('summary_details/add', 'SummaryDetailsController@getAddSummaryDetails')->name('add_details');
Route::get('summary_details/add-era', 'SummaryDetailsController@getAddEra')->name('add_era');

Route::get('auth', 'Auth\AuthController@index')->name('auth.index');
Route::post('auth', 'Auth\AuthController@store')->name('auth.store');
Route::get('auth/logout', 'Auth\AuthController@logout')->name('auth.logout');

Route::get('password/reset', 'Auth\PasswordController@showResetForm')->name('password.reset');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset', 'Auth\PasswordController@reset')->name('password.update');

Route::get('home', 'HomeController@index')->name('home.index');
