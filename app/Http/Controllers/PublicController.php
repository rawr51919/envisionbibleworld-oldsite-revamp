<?php
namespace App\Http\Controllers;
use App\Category;
use App\Era;
use App\Source;
use App\SubCategory;
use App\SummaryDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;


class PublicController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('public');
    }
        
        public function aboutdatabase()
        {
            return view('public.aboutdatabase');
        }

    public function background()
    {
        return view('public.backgroundinfo');
    }

    public function beliefs()
    {
        return view('public.doctrinalstatement');
    }

    public function categories()
    {
        $items = Category::select('Category','CategoryId')->orderBy('Category')->get()->lists('Category', 'CategoryId');
        return view('public.categories', compact('items'));
    }

    public function eras()
    {
        return view('public.eras');
    }

    public function sources()
    {
        return view('public.sources');
    }

    public function contact()
    {
        $success = false;
        return view('public.contact', compact('success'));
    }

    public function standard()
    {
        return view('public.standard');
    }

    public function locations()
    {
        return view('public.locations');
    }

    public function sacrifices()
    {
        return view('public.sacrifices');
    }

    public function lifestylesofjesustime()
    {
        return view('public.lifestyles-jesus-time');
    }
        
    public function oldandnew()
    {
        return view('public.oldandnewtestamenttimes');
    }

    public function stories()
    {
        return view('public.storiesaboutjesus');
    }

    public function getPublicSources(){

//        This code is for postgreSql database
//        $subQuery = Source::select(DB::raw('DISTINCT ON ("SourceName") "SourceName", "SourceId"'));
        $subQuery = Source::select(DB::raw('DISTINCT SourceName, SourceId'));

        $query = Source::select()->from(DB::raw(' ( ' . $subQuery->toSql() . ' ) AS sources '))
            ->orderBy('SourceId')
            ->get();

        return Datatables::of($query)->make(true);
    }

    public function getPublicSubCategories(Request $request) {
        $id = $request->id;
        return Datatables::of(SubCategory::select('Subcategory')->where('CategoryId', '=', $id))->make(true);
    }

    public function getPublicEras() {
        return Datatables::of(Era::query()->get())->make(true);
    }

    public function getPublicStandard() {
        $data = SummaryDetails::leftJoin('tblSummary', 'tblSummary_Details.SummaryId', '=', 'tblSummary.SummaryId')

            //For version 2, 3
            //When next students develop version 2 and 3, they can uncomment out under code and use them.
            //->leftJoin('tblSacrifice', 'tblSummary_Details.SacrificeId', '=', 'tblSacrifice.SacrificeId')
            //->leftJoin('tblLocation', 'tblSummary_Details.LocationId', '=', 'tblLocation.LocationId')

            ->leftJoin('tblSource_Quoted', 'tblSummary_Details.Source_QuotedId', '=', 'tblSource_Quoted.Source_QuotedId')
            ->leftJoin('tblSource', 'tblSource_Quoted.SourceId', '=', 'tblSource.SourceId')
            ->leftJoin('tblSource_Type', 'tblSource.Source_TypeId', '=', 'tblSource_Type.Source_TypeId')
            ->leftJoin('tblQuotation', 'tblSummary_Details.QuotationId', '=', 'tblQuotation.QuotationId')
            ->leftJoin('tblEra', 'tblSummary_Details.EraId', '=', 'tblEra.EraId')

            ->leftJoin('tblSubCategory', 'tblSummary_Details.SubcategoryId', '=', 'tblSubCategory.SubcategoryId')
            ->leftJoin('tblCategory', 'tblSubCategory.CategoryId', '=', 'tblCategory.CategoryId')
            ->leftJoin('tblStatusType', 'tblSummary_Details.StatusTypeId', '=', 'tblStatusType.StatusTypeId')
            ->select('tblSummary_Details.Summary_DetailsId','tblSummary.Summary', 'tblEra.Era', 'tblCategory.Category',   'tblSubCategory.Subcategory',
                'tblSource.SourceName', 'tblSource_Type.Source_Type', 'tblSource_Type.Source_Type_Abbreviation', 'tblSource_Quoted.BeginChptrSectionMinute', 'tblSource_Quoted.BeginVersePageSecond',
                'tblSource_Quoted.EndChptrSectionMinute', 'tblSource_Quoted.EndVersePageSecond', 'tblSource_Quoted.Source_Explanation',
                'tblQuotation.Quotation', 'tblStatusType.StatusType')
                        ->where('tblSummary_Details.StatusTypeId', '=', '2')
            ->get();
        return Datatables::of($data)->make(true);
    }
}
