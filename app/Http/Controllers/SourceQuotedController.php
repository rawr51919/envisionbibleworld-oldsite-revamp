<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Source;
use App\SourceQuoted;
use Illuminate\Http\Request;

class SourceQuotedController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('sourcequoted.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    public function getSourceQuoted()
    {
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];


        // $fields = explode(', ', $sidx.''.$sord); (unused for now)

        $count = SourceQuoted::all()->count();
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

        $query = DB::table('tblSource_Quoted');
        $query->leftJoin('tblStatusType', 'tblSource_Quoted.StatusTypeId', '=', 'tblStatusType.StatusTypeId')
            ->leftJoin('tblSource', 'tblSource_Quoted.SourceId', '=', 'tblSource.SourceId');
        if (isset($_GET['SourceId'])) {
            $query->where('tblSource_Quoted.SourceId', $_GET['SourceId']);
        }
        $query->select(
            'tblSource_Quoted.Source_QuotedId',
            'tblSource_Quoted.SourceId',
            'tblSource_Quoted.BeginChptrSectionMinute',
            'tblSource_Quoted.BeginVersePageSecond',
            'tblSource_Quoted.EndChptrSectionMinute',
            'tblSource_Quoted.EndVersePageSecond',
            'tblSource_Quoted.Source_Explanation',
            'tblStatusType.StatusType',
            //				DB::raw(' "tblSource"."SourceId", "tblSource"."SourceName" || \' Last Chapter\Section: \' || "tblSource"."LastChptrOrSection" || \' Chapter of Last Verse: \' || "tblSource"."ChptrOfLastVrs" || \' Last Verse or Page: \' || "tblSource"."LastVerseOrPage" AS "SourceName" ')
            'tblSource.SourceName'
        )
            ->skip($start)->take($limit)
            ->orderBy($sidx, $sord)
            ->get();

        $sources = $query->get();

        $res = array('page' => $page, 'total' => $total_pages, 'records' => $count, 'rows' => $sources);
        return response()->json($res);
    }

    public function getSources()
    {

        // This is for MySQL
        $sources = Source::select(
            //			DB::raw(' SourceId, CONCAT( "SourceId", "SourceName", "LastChptrOrSection", "ChptrOfLastVrs", "LastVerseOrPage" ) AS SourceName'
            //			)
        )->lists('SourceName', 'SourceId');


        // $sources = Source::lists('SourceName', 'SourceId'); (unused for now)

        //Under code is for PostgreSQL
        //		$sources = Source::select(
        //                //DB::raw(' "tblSource"."SourceId", "tblSource"."SourceName" || \' Last Chapter\Section: \' || "tblSource"."LastChptrOrSection" || \' Chapter of Last Verse: \' || "tblSource"."ChptrOfLastVrs" || \' Last Verse or Page: \' || "tblSource"."LastVerseOrPage" AS "SourceName" ')
        //            )->lists('SourceName', 'SourceId');

        return response()->json($sources);
    }

    public function postUpdateSourceQuoted(Request $request)
    {
        //Get SourceQuoted ID and changing data
        $id = $request->Source_QuotedId;

        //Get SourceQuoted stuff

        try {
            if (is_numeric($id)) {
                $source_quoted = SourceQuoted::find($id);
                if (is_numeric($request->BeginChptrSectionMinute)) {
                    $source_quoted->BeginChptrSectionMinute = $request->BeginChptrSectionMinute;
                } else {
                    $source_quoted->BeginChptrSectionMinute = null;
                }
                if (is_numeric($request->BeginVersePageSecond)) {
                    $source_quoted->BeginVersePageSecond = $request->BeginVersePageSecond;
                } else {
                    $source_quoted->BeginVersePageSecond = null;
                }
                if (is_numeric($request->EndChptrSectionMinute)) {
                    $source_quoted->EndChptrSectionMinute = $request->EndChptrSectionMinute;
                } else {
                    $source_quoted->EndChptrSectionMinute = null;
                }
                if (is_numeric($request->EndVersePageSecond)) {
                    $source_quoted->EndVersePageSecond = $request->EndVersePageSecond;
                } else {
                    $source_quoted->EndVersePageSecond = null;
                }

                $source_quoted->SourceId = $request->SourceName;
                $source_quoted->Source_Explanation = $request->Source_Explanation;
                $source_quoted->StatusTypeId = $request->StatusType;
                $source_quoted->save();
            } else {
                $newSourceQuoted = new SourceQuoted();
                if (is_numeric($request->BeginChptrSectionMinute)) {
                    $newSourceQuoted->BeginChptrSectionMinute = $request->BeginChptrSectionMinute;
                } else {
                    $newSourceQuoted->BeginChptrSectionMinute = null;
                }
                if (is_numeric($request->BeginVersePageSecond)) {
                    $newSourceQuoted->BeginVersePageSecond = $request->BeginVersePageSecond;
                } else {
                    $newSourceQuoted->BeginVersePageSecond = null;
                }
                if (is_numeric($request->EndChptrSectionMinute)) {
                    $newSourceQuoted->EndChptrSectionMinute = $request->EndChptrSectionMinute;
                } else {
                    $newSourceQuoted->EndChptrSectionMinute = null;
                }
                if (is_numeric($request->EndVersePageSecond)) {
                    $newSourceQuoted->EndVersePageSecond = $request->EndVersePageSecond;
                } else {
                    $newSourceQuoted->EndVersePageSecond = null;
                }

                $newSourceQuoted->SourceId = $request->SourceName;
                $newSourceQuoted->Source_Explanation = $request->Source_Explanation;
                $newSourceQuoted->StatusTypeId = $request->StatusType;
                $newSourceQuoted->save();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('result' => false, 'msg' => 'Save failed!!'));
        }
        DB::commit();

        return response()->json(array('result' => true, 'msg' => 'Successfully saved!!'));
    }

    public function postDeleteSourceQuoted(Request $request)
    {
        $id = $request->Source_QuotedId;

        try {

            DB::beginTransaction();

            $source_quoted = SourceQuoted::find($id);
            $source_quoted->delete();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('result' => false, 'msg' => 'Deleted failed!!'));
        }
        DB::commit();

        return response()->json(array('result' => true, 'msg' => 'Successfully Deleted!!'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
