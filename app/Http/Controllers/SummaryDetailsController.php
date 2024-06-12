<?php

namespace App\Http\Controllers;

use App\Category;
use App\Era;
use App\EraYear;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Quotation;
use App\Source;
use App\SourceQuoted;
use App\SourceType;
use App\SubCategory;
use App\Summary;
use App\SummaryDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SummaryDetailsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $era_years = EraYear::all();

        return view('standard.index', compact('era_years'));
    }

    public function getSummaryDetails(Request $request)
    {

        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

        $fields = explode(', ', $sidx . '' . $sord);

        $count = SummaryDetails::all()->count();
        if ($count > 0 && $limit > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages) {
            $page = $total_pages;
        }


        $start = $limit * $page - $limit;
        if ($start < 0) {
            $start = 0;
        }

        $query = DB::table('tblSummary_Details');
        $query->leftJoin('tblSummary', 'tblSummary_Details.SummaryId', '=', 'tblSummary.SummaryId')

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
            ->select(
                'tblSummary_Details.Summary_DetailsId',
                'tblSummary.Summary',
                'tblEra.Era',
                'tblCategory.Category',
                'tblSubCategory.Subcategory',
                'tblSource.SourceName',
                'tblSource_Type.Source_Type',
                'tblSource_Quoted.BeginChptrSectionMinute',
                'tblSource_Quoted.BeginVersePageSecond',
                'tblSource_Quoted.EndChptrSectionMinute',
                'tblSource_Quoted.EndVersePageSecond',
                'tblSource_Quoted.Source_Explanation',
                'tblQuotation.Quotation',
                'tblStatusType.StatusType',
                'tblSource_Type.Source_Type_Abbreviation'
            );

        if ($request->_type != 'bottom') {
            $query->skip($start)->take($limit);
        }
        if ($request->_type == 'bottom') {
            if ($request->searchField != '') {
                if ($request->searchOper == 'cn') {
                    $query->where($request->searchField, 'like', '%' . $request->searchString . '%');
                } else {
                    $query->where($request->searchField, '=', $request->searchString);
                }
            } else {
                $query->where('Category', '=', '########');
            }
        }

        if (sizeof($fields) == 1) {
            $query->orderBy(trim($sidx), $sord);
        } elseif (sizeof($fields) > 1) {
            foreach ($fields as $value) {
                $orders = explode(' ', $value);
                $query->orderBy(trim($orders[0]), $orders[1]);
            }
        }

        $summary_details = $query->get();

        $res = array('page' => $page, 'total' => $total_pages, 'records' => $count, 'rows' => $summary_details);

        return response()->json($res);
    }

    /***
     * This function is for update summary and quotation data via ajax
     * When user change summary or quotation on the grid, it is saved through this function.
     * @param Request $request
     */
    public function postUpdateSummaryDetails(Request $request)
    {
        //Get Summary_Details ID and changing data such as summary, quotation
        $id = $request->Summary_DetailsId;
        $newSummary = $request->Summary;
        $newQuotation = $request->Quotation;
        $eraId = $request->Era;
        // $categoryId = $request->Category; (unused for now)
        $subcategoryId = $request->Subcategory;
        $sourceName = $request->SourceName;
        $sourceType = $request->Source_Type;
        $beginChptrSectionMinute = $request->BeginChptrSectionMinute;
        $beginVersePageSecond = $request->BeginVersePageSecond;
        $endChptrSectionMinute = $request->EndChptrSectionMinute;
        $endVersePageSecond = $request->EndVersePageSecond;
        $source_Explanation = $request->Source_Explanation;
        $sacrificeId = $request->Sacrifice;
        $locationId = $request->Location;
        $statusTypeId = $request->StatusType;


        //Get Summary_Details data to get summaryId and quotationId
        $summaryDetails = SummaryDetails::find($id);

        //Start transaction
        DB::beginTransaction();

        //Update Summary and Quotation
        try {
            $summaryObj = Summary::find($summaryDetails->SummaryId);
            $summaryObj->Summary = $newSummary;
            $summaryObj->save();

            $quotationObj = Quotation::find($summaryDetails->QuotationId);
            $quotationObj->Quotation = $newQuotation;
            $quotationObj->save();

            //update begin/end section and verse
            $sourceQuotedObj = SourceQuoted::find($summaryDetails->Source_QuotedId);
            $sourceQuotedObj->BeginChptrSectionMinute = $beginChptrSectionMinute;
            $sourceQuotedObj->BeginVersePageSecond = $beginVersePageSecond;
            $sourceQuotedObj->EndChptrSectionMinute = $endChptrSectionMinute;
            $sourceQuotedObj->EndVersePageSecond = $endVersePageSecond;
            $sourceQuotedObj->Source_Explanation = $source_Explanation;
            $sourceQuotedObj->save();

            //update source name;
            $sourceObj = Source::find($sourceQuotedObj->SourceId);
            $sourceObj->SourceName = $sourceName;
            $sourceObj->save();

            //Update source_type name
            $sourceTypeObj = SourceType::find($sourceObj->Source_TypeId);
            $sourceTypeObj->Source_Type = $sourceType;
            $sourceTypeObj->save();

            $summaryDetails->EraId = $eraId;
            $summaryDetails->SacrificeId = $sacrificeId;
            $summaryDetails->LocationId = $locationId;
            $summaryDetails->SubcategoryId = $subcategoryId;
            $summaryDetails->StatusTypeId = $statusTypeId;
            $summaryDetails->save();
        } catch (\Exception $e) {
            DB::rollback();
        }

        DB::commit();
    }


    public function postDeleteSummaryDetails(Request $request)
    {
        //Get Category ID and changing data
        $id = $request->id;

        try {
            $summaryDetail = SummaryDetails::find($id);
            //change statusType to delete condition.
            $summaryDetail->StatusTypeId = '4';
            $summaryDetail->save();
        } catch (\Exception $e) {
            return response()->json(array('result' => false, 'msg' => 'Deleted failed!!'));
        }

        return response()->json(array('result' => true, 'msg' => 'Successfully Deleted!!'));
    }

    /***
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getEras()
    {

        $eras = Era::lists('Era', 'EraId');

        return response()->json($eras);
    }


    public function getEraOptions()
    {

        $eras = Era::orderBy('Era', 'asc')->get();

        $options = '<option value="-1">== Select Era ==</option>';
        foreach ($eras as $era) {
            $options .= '<option value="' . $era->EraId . '">' . $era->Era . '</option>';
        }
        return response()->json($options);
    }
    public function getSummaryOptions()
    {

        $summaries = Summary::orderBy('Summary', 'asc')->get();

        $options = '<option value="-1">== Select Summary ==</option>';
        foreach ($summaries as $summary) {
            $options .= '<option value="' . $summary->SummaryId . '">' . $summary->Summary . '</option>';
        }
        return response()->json($options);
    }

    public function getCategoryOptions()
    {

        $categories = Category::orderBy('Category', 'asc')->get();
        $options = '<option value="-1">== Select Category ==</option>';
        foreach ($categories as $category) {

            $options .= '<option value="' . $category->CategoryId . '">' . $category->Category . '</option>';
        }
        return response()->json($options);
    }


    public function getSourceOptions()
    {

        $sources = Source::orderBy('SourceName', 'asc')->get();
        $options = '<option value="-1">== Select Source ==</option>';
        foreach ($sources as $source) {
            $options .= '<option value="' . $source->SourceId . '">Name: ' . $source->SourceName . ', ';
            $options .= 'LastChptr: ' . $source->LastChptrOrSection . ', ';
            $options .= 'ChptrOfLastVrs: ' . $source->ChptrOfLastVrs . ', ';
            $options .= 'LastVerseOrPage: ' . $source->LastVerseOrPage;
            $options .= ' </option>';
        }
        return response()->json($options);
    }


    public function getSourceQuotedOptions(Request $request)
    {

        //This is for PostgreSQL database.
        //        $sourceQuoted = SourceQuoted::select(
        //            DB::raw(' \'BeginChpt:\' || "BeginChptrSectionMinute" || \', BeVers:\' || "BeginVersePageSecond" ||
        //                \', EndChpt:\' || "EndChptrSectionMinute" || \', EndVers:\' || "EndVersePageSecond" AS "Name", "Source_QuotedId" '))
        //            ->where('SourceId', $request->SourceId )->get();


        //This is for mySQL database
        $sourceQuoted = SourceQuoted::where('SourceId', $request->SourceId)->get();

        $options = '';
        foreach ($sourceQuoted as $quoted) {
            $options .= '<option value="' . $quoted->Source_QuotedId . '">';
            $options .= 'BeginChpt: ' . $quoted->BeginChptrSectionMinute . ', ';
            $options .= 'BeginVers: ' . $quoted->BeginVersePageSecond . ', ';
            $options .= 'EndChpt: ' . $quoted->EndChptrSectionMinute . ', ';
            $options .= 'EndVers: ' . $quoted->EndVersePageSecond;
            $options .= '</option>';
        }
        return response()->json($options);
    }

    public function getQuotationOptions()
    {

        $quotations = Quotation::orderBy('Quotation', 'asc')->get();
        $options = '<option value="-1">== Select Quotation ==</option>';
        foreach ($quotations as $quotation) {

            $options .= '<option value="' . $quotation->QuotationId . '">' . $quotation->Quotation . '</option>';
        }
        return response()->json($options);
    }



    public function getCategories()
    {

        $categories = Category::lists('Category', 'CategoryId');
        return response()->json($categories);
    }

    public function getSubcategories(Request $request)
    {

        if ($request->CategoryId == null) {
            $subcategories = SubCategory::lists('Subcategory', 'SubcategoryId');

            return response()->json($subcategories);
        } else {
            $subcategories = SubCategory::select('Subcategory', 'SubcategoryId')->where('CategoryId', $request->CategoryId)->get();
            $options = '';
            foreach ($subcategories as $sub) {
                if ($request->SubcategoryId == $sub->SubcategoryId) {
                    $options .= '<option value="' . $sub->SubcategoryId . '" selected="selected">' . $sub->Subcategory . '</option>';
                } else {
                    $options .= '<option value="' . $sub->SubcategoryId . '">' . $sub->Subcategory . '</option>';
                }
            }
            return response()->json($options);
        }
    }


    public function getAddSummaryDetails(Request $request)
    {
        $summaryId = $request->SummaryId;
        $sourceQuotedId = $request->Source_QuotedId;
        $subcategoryId = $request->SubcategoryId;
        $quotationId = $request->QuotationId;
        $eraId = $request->EraId;
        $locationId = $request->LocationId;
        $sacrificeId = $request->SacrificeId;


        try {
            $summaryDetails = new SummaryDetails();
            $summaryDetails->SummaryId = $summaryId;
            $summaryDetails->QuotationId = $quotationId;
            $summaryDetails->EraId = $eraId;
            $summaryDetails->SubcategoryId = $subcategoryId;
            $summaryDetails->Source_QuotedId = $sourceQuotedId;
            $summaryDetails->StatusTypeId = 6;
            $summaryDetails->LocationId = $locationId;
            $summaryDetails->SacrificeId = $sacrificeId;

            $summaryDetails->save();
        } catch (\Exception $e) {
            return response()->json(array('result' => false, 'msg' => ' Fail to add.'));
        }

        return response()->json(array('result' => true, 'msg' => 'Added Standard Entry successfully.'));
    }

    public function getAddEra(Request $request)
    {

        $era = $request->Era;
        $begin_year_id = $request->BeginYearId;
        $end_year_id = $request->EndYearId;

        if ($era == '' || $begin_year_id == '' || $end_year_id == '') {
            return response()->json(array('result' => false, 'msg' => 'Insert failed!!'));
        }
        //Start transaction
        DB::beginTransaction();

        //Update Summary and Quotation
        try {
            $era = new Era;
            $era->Era = $era;
            $era->save();

            DB::table('tblEra_BeginEnd')->insert(
                ['EraId' => $era->EraId, 'BeginYearId' => $begin_year_id, 'EndYearId' => $end_year_id]
            );
        } catch (\Exception $e) {
            DB::rollback();
        }

        DB::commit();

        return response()->json(array('result' => true, 'msg' => 'Era is Added successfully.'));
    }
}
