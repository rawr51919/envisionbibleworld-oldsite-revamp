<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Summary;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Session;

class SummaryController extends Controller {

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
        return view('summary.index');
    }

    public function getSummaries() {

        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

        $fields = explode(', ', $sidx.''.$sord);

        $count = Summary::all()->count();
        if( $count > 0 && $limit > 0) {
            $total_pages = ceil($count/$limit);
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

        $summaries = Summary::skip($start)
            ->take($limit)
            ->orderBy($sidx, $sord)
            ->get();

        $res = array('page'=>$page,'total'=>$total_pages, 'records'=>$count, 'rows'=>$summaries);
        return response()->json($res);
    }

    public function postDeleteSummary(Request $request) {
        $id = $request->SummaryId;

        try{

            DB::beginTransaction();

            $summary = Summary::find($id);
            $summary->delete();

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('result'=>false, 'msg'=>'Deleted failed!!'));
        }
        DB::commit();

        return response()->json(array('result'=>true, 'msg'=>'Successfully Deleted!!'));
    }

    public function postUpdateSummary(Request $request) {
        //Get Category ID and changing data
        $id = $request->SummaryId;

        try{
            DB::beginTransaction();

            if(is_numeric($id)) {
                $summary = Summary::find($id);
                $summary->Summary = $request->Summary;
                $summary->StatusTypeId = $request->StatusTypeId;
                $summary->save();
            } else {
                $newSummary = new Summary();
                $newSummary->Summary = $request->Summary;
                $newSummary->StatusTypeId = $request->StatusTypeId;
                $newSummary->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
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
