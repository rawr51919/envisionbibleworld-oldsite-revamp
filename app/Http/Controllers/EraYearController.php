<?php

namespace App\Http\Controllers;

use App\EraYear;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EraYearController extends Controller
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
        return view('erayear.index');
    }

    public function getEraYears()
    {
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

        $count = EraYear::all()->count();
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

        $eras = EraYear::select(
            //Under code is for PostgreSQL
            //            DB::raw('replace(replace(CAST("IsBC" AS TEXT), \'false\', \'AD\'), \'true\', \'BC\') AS "IsBC", "Era_YearId", "Year"')

            //For mySQL
            DB::raw('if(IsBC, \'BC\', \'AD\') AS IsBC, Era_YearId, Year')
        )
            ->skip($start)->take($limit)
            ->orderBy($sidx, $sord)
            ->get();

        $res = array('page' => $page, 'total' => $total_pages, 'records' => $count, 'rows' => $eras);
        return response()->json($res);
    }

    public function postUpdateEraYear(Request $request)
    {
        //Get Category ID and changing data
        $id = $request->Era_YearId;
        $year = $request->Year;
        $isBC = $request->IsBC;

        //Get Summary_Details data to get summaryId and quotationId

        try {
            DB::beginTransaction();
            if (is_numeric($id)) {
                $era = EraYear::find($id);
                $era->Year = $year;
                $era->IsBC = $isBC;
                $era->save();
            } else {
                $era = new EraYear();
                $era->Year = $year;
                $era->IsBC = $isBC;
                $era->save();
            }
        } catch (\Exception $e) {
            DB::rollback();
        }
        DB::commit();
    }

    public function postDeleteEraYear(Request $request)
    {
        //Get Category ID and changing data
        $id = $request->Era_YearId;

        try {
            DB::beginTransaction();
            $era = EraYear::find($id);
            $era->delete();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('result' => false, 'msg' => 'Deleted failed!!'));
        }
        DB::commit();

        return response()->json(array('result' => true, 'msg' => 'Successfully Deleted!!'));
    }
}
