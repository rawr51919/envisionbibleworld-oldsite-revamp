<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LegacyWelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\SourceQuotedController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\DatatablesController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\EraController;
use App\Http\Controllers\SourceTypeController;
use App\Http\Controllers\EraYearController;
use App\Http\Controllers\SummaryDetailsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;

Route::get('welcome', [WelcomeController::class, 'index']);

Route::get('welcome-legacy', [LegacyWelcomeController::class, 'index']);

Route::get('login', [AuthController::class, 'login']);

Route::get('admin', [HomeController::class, 'index']);

Route::get('home', [HomeController::class, 'index']);

Route::resource('category', CategoryController::class);

Route::resource('subcategory', SubCategoryController::class);

Route::resource('source', SourceController::class);

Route::resource('sourcequoted', SourceQuotedController::class);

Route::resource('summary', SummaryController::class);

//Public access routes
Route::get('/', [PublicController::class, 'index']);
Route::get('open', [PublicController::class, 'index']);
Route::get('public', [PublicController::class, 'index']);
Route::get('publicstandard', [PublicController::class, 'standard']);
Route::get('categories', [PublicController::class, 'categories']);
Route::get('eras', [PublicController::class, 'eras']);
Route::get('sources', [PublicController::class, 'sources']);
Route::get('background', [PublicController::class, 'background']);
Route::get('beliefs', [PublicController::class, 'beliefs']);
Route::get('search', [PublicController::class, 'topical']);
Route::get('explore', [PublicController::class, 'explore']);
Route::get('contact-us', [PublicController::class, 'contact']);
Route::get('locations', [PublicController::class, 'locations']);
Route::get('sacrifices', [PublicController::class, 'sacrifices']);
Route::get('lifestylesofjesustime', [PublicController::class, 'lifestyles']);
Route::get('lifestyles-jesus-time', [PublicController::class, 'lifestyles']);
Route::get('oldandnewtestamenttimes', [PublicController::class, 'oldandnew']);
Route::get('old-new-testament-times', [PublicController::class, 'oldandnew']);
Route::get('storiesaboutjesus', [PublicController::class, 'stories']);
Route::get('stories-about-jesus', [PublicController::class, 'stories']);
Route::get('aboutdatabase', [PublicController::class, 'aboutdatabase']);
Route::get('about-database', [PublicController::class, 'aboutdatabase']);
Route::get('what-drove-my-ambition', [PublicController::class, 'ambition']);
Route::get('what-drives-my-passion', [PublicController::class, 'passion']);
Route::get('doctrinal-statement', [PublicController::class, 'beliefs']);
Route::get('what-are-the-limits-for-this-database', [PublicController::class, 'background']);
Route::get('about-me', [PublicController::class, 'topical']);

Route::get('/open', [PublicController::class, 'index'])->name('open');
Route::get('/open/subcategories', [PublicController::class, 'getPublicSubCategories'])->name('getpublicsubcategories');
Route::get('/open/sources', [PublicController::class, 'getPublicSources'])->name('getpublicsources');
Route::get('/open/eras', [PublicController::class, 'getPublicEras'])->name('getpubliceras');
Route::get('/open/standard', [PublicController::class, 'getPublicStandard'])->name('getpublicstandard');

Route::post('contact', [EnquiryController::class, 'index']);

Route::get('datatables', [DatatablesController::class, 'anyData'])->name('datatables.data');
Route::get('datatables', [DatatablesController::class, 'getIndex'])->name('datatables');

Route::get('category', [CategoryController::class, 'index']);
Route::get('categories', [CategoryController::class, 'getCategories'])->name('categories');
Route::get('categories/subcategories', [CategoryController::class, 'getSubcategories'])->name('subcategories');
Route::post('categories/update', [CategoryController::class, 'postUpdateCategory'])->name('updatecategory');
Route::post('categories/delete', [CategoryController::class, 'postDeleteCategory'])->name('deletecategory');
Route::post('categories/subcategories/update', [CategoryController::class, 'postUpdateSubcategory'])->name('updatesubcategory');
Route::post('categories/subcategories/delete', [CategoryController::class, 'postDeleteSubcategory'])->name('deletesubcategory');
Route::get('categories/public', [CategoryController::class, 'getPublicCategories'])->name('getpubliccategories');

Route::get('subcategories', [SubCategoryController::class, 'getSubcategories'])->name('subcategories');
Route::post('subcategories/update', [SubCategoryController::class, 'postUpdateSubcategory'])->name('updatesubcategory');
Route::post('subcategories/delete', [SubCategoryController::class, 'postDeleteSubcategory'])->name('deletesubcategory');

Route::get('summaries', [SummaryController::class, 'getSummaries'])->name('summaries');
Route::post('summaries/update', [SummaryController::class, 'postUpdateSummary'])->name('updatesummary');
Route::post('summaries/delete', [SummaryController::class, 'postDeleteSummary'])->name('deletesummary');

Route::get('sources', [SourceController::class, 'getSources'])->name('sources');
Route::post('sources/update', [SourceController::class, 'postUpdateSource'])->name('updatesource');
Route::post('sources/delete', [SourceController::class, 'postDeleteSource'])->name('deletesource');
Route::get('sources/status-types', [SourceController::class, 'getStatusTypes'])->name('statustypes');
Route::get('sources/publishers', [SourceController::class, 'getPublishers'])->name('publishers');
Route::get('sources/source-types', [SourceController::class, 'getSourceTypes'])->name('sourcetypes');
Route::get('sources/details', [SourceController::class, 'getSourceDetails'])->name('source_details');
Route::post('sources/details/edit', [SourceController::class, 'postEditSourceDetail'])->name('editsource_detail');
Route::post('sources/details/delete', [SourceController::class, 'postDeleteSourceDetail'])->name('deletesource_detail');
Route::post('sources/details/add', [SourceController::class, 'postAddSourceDetail'])->name('addsource_detail');

// Quotation
Route::get('quotation', [QuotationController::class, 'index']);
Route::get('quotations', [QuotationController::class, 'getQuotation'])->name('quotations');
Route::get('quotations/status-types', [QuotationController::class, 'getStatusTypes'])->name('status_types');
Route::post('quotations/update', [QuotationController::class, 'postUpdateQuotation'])->name('update_quotation');
Route::post('quotations/delete', [QuotationController::class, 'postDeleteQuotation'])->name('delete_quotation');

Route::get('sourcesquoted', [SourceQuotedController::class, 'getSourceQuoted'])->name('sourcesquoted');
Route::post('sourcesquoted/update', [SourceQuotedController::class, 'postUpdateSourceQuoted'])->name('updatesourcequoted');
Route::post('sourcesquoted/delete', [SourceQuotedController::class, 'postDeleteSourceQuoted'])->name('deletesourcequoted');
Route::get('sourcesquoted/sources', [SourceQuotedController::class, 'getSources'])->name('getsources_quoted');

// Era
Route::get('era', [EraController::class, 'index']);
Route::get('eras', [EraController::class, 'getEras'])->name('eras');
Route::get('eras/years', [EraController::class, 'getEraYears'])->name('era_years');
Route::post('eras/update', [EraController::class, 'postUpdateEra'])->name('update_era');
Route::post('eras/delete', [EraController::class, 'postDeleteEra'])->name('delete_era');

// Source Type
Route::get('sourcetype', [SourceTypeController::class, 'index']);
Route::get('sourcetypes', [SourceTypeController::class, 'getSourceTypes'])->name('source_types');
Route::post('sourcetypes/update', [SourceTypeController::class, 'postUpdateSourceType'])->name('update_source_type');
Route::post('sourcetypes/delete', [SourceTypeController::class, 'postDeleteSourceType'])->name('delete_source_type');

Route::get('erayear', [EraYearController::class, 'index']);
Route::get('erayears', [EraYearController::class, 'getEraYears'])->name('erayears');
Route::post('erayears/update', [EraYearController::class, 'postUpdateEraYear'])->name('update_era_year');
Route::post('erayears/delete', [EraYearController::class, 'postDeleteEraYear'])->name('delete_era_year');

Route::get('standard', [SummaryDetailsController::class, 'index']);
Route::get('summary_details', [SummaryDetailsController::class, 'getSummaryDetails'])->name('summary_details');
Route::get('summary_details/eras-for-combobox', [SummaryDetailsController::class, 'getEras'])->name('eras_for_combobox');
Route::get('summary_details/categories-for-combobox', [SummaryDetailsController::class, 'getCategories'])->name('category_for_combobox');
Route::get('summary_details/subcategories-for-combobox', [SummaryDetailsController::class, 'getSubcategories'])->name('subcategory_for_combobox');
Route::get('summary_details/summaries-for-input', [SummaryDetailsController::class, 'getSummaryOptions'])->name('summaries_for_input');
Route::get('summary_details/categories-for-input', [SummaryDetailsController::class, 'getCategoryOptions'])->name('categories_for_input');
Route::get('summary_details/eras-for-input', [SummaryDetailsController::class, 'getEraOptions'])->name('eras_for_input');
Route::get('summary_details/sources-for-input', [SummaryDetailsController::class, 'getSourceOptions'])->name('sources_for_input');
Route::get('summary_details/sources-quoted-for-input', [SummaryDetailsController::class, 'getSourceQuotedOptions'])->name('source_quoted_for_input');
Route::get('summary_details/quotations-for-input', [SummaryDetailsController::class, 'getQuotationOptions'])->name('quotations_for_input');
Route::post('summary_details/update', [SummaryDetailsController::class, 'postUpdateSummaryDetails'])->name('update_details');
Route::post('summary_details/delete', [SummaryDetailsController::class, 'postDeleteSummaryDetails'])->name('delete_details');
Route::get('summary_details/add', [SummaryDetailsController::class, 'getAddSummaryDetails'])->name('add_details');
Route::get('summary_details/add-era', [SummaryDetailsController::class, 'getAddEra'])->name('add_era');

Route::get('auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('auth', [AuthController::class, 'store'])->name('auth.store');
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('password/reset', [PasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/email', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('password/reset', [PasswordController::class, 'reset'])->name('password.update');

Route::get('home', [HomeController::class, 'index'])->name('home.index');

