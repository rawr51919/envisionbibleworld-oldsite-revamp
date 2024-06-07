<?php namespace App\Http\Controllers;

use App\Era;
use App\EraYear;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class EraController extends Controller {

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
		return view('era.index');
	}

    public function getEras() {

        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

        $fields = explode(', ', $sidx.''.$sord);

        $count = Era::all()->count();
        if( $count > 0 && $limit > 0) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages)
            $page = $total_pages;


        $start = $limit * $page - $limit;
        if($start < 0) $start = 0;

        $eras = Era::leftJoin('tblEra_BeginEnd', 'tblEra.EraId', '=', 'tblEra_BeginEnd.EraId')

            //Under code is for PostgreSQL
//            ->select(
//                DB::raw(' "tblEra"."EraId", "tblEra"."Era",
//                        (SELECT replace(replace(CAST("IsBC" AS TEXT), \'false\', \'AD\'), \'true\', \'BC\') || \' \' || "Year"
//                            from "tblEra_Year" WHERE "Era_YearId" = "tblEra_BeginEnd"."BeginYearId") AS "BeginYear",
//                        (SELECT replace(replace(CAST("IsBC" AS TEXT), \'false\', \'AD\'), \'true\', \'BC\') || \' \' || "Year" AS "Year"
//                            from "tblEra_Year" WHERE "Era_YearId" = "tblEra_BeginEnd"."EndYearId") AS "EndYear"'
//                )
//            )

            //Under is for MySQL database
            ->select(
                DB::raw(' tblEra.EraId, tblEra.Era,
                        (SELECT  CONCAT( if(tblEra_Year.IsBC, \'BC\', \'AD\') , \' \' , Year )
                            from tblEra_Year WHERE tblEra_Year.Era_YearId = tblEra_BeginEnd.BeginYearId) AS BeginYear,
                        (SELECT CONCAT( if(tblEra_Year.IsBC, \'BC\', \'AD\') , \' \' , Year )
                            from tblEra_Year WHERE tblEra_Year.Era_YearId = tblEra_BeginEnd.EndYearId) AS EndYear'
                )
            )
            ->skip($start)->take($limit)
            ->orderBy($sidx, $sord)
            ->get();

//        foreach($eras as $era) {
//            $era->BeginYear = str_replace('true', 'BC', $era->BeginYear);
//            $era->BeginYear = str_replace('false', 'AD', $era->BeginYear);
//            $era->EndYear = str_replace('true', 'BC', $era->EndYear);
//            $era->EndYear = str_replace('false', 'AD', $era->EndYear);
//        }

        $res = Array('page'=>$page,'total'=>$total_pages, 'records'=>$count, 'rows'=>$eras);
        return response()->json($res);
    }

    public function postUpdateEra(Request $request) {
        //Get Category ID and changing data
        $id = $request->EraId;
        $eraName = $request->Era;
		$eraExplain = $request->Era_Explanation;
        $eraBeginYear = $request-> BeginYear;
        $eraEndYear = $request-> EndYear;
        //Get Summary_Details data to get summaryId and quotationId

        try{
			DB::beginTransaction();
            if(is_numeric($id)) {
                $era = Era::find($id);
                $era->Era = $eraName;
                $era->Era_Explanation = $eraExplain;
                $era->save();


                DB::table('tblEra_BeginEnd')
                    ->where('EraId',$id)
                    ->update(['BeginYearId' => $eraBeginYear, 'EndYearId' => $eraEndYear]);
            }else{
                $era = new Era;
                $era->Era = $eraName;
                $era->Era_Explanation = $eraExplain;
                $era->save();

                DB::table('tblEra_BeginEnd')
                    ->insert(['EraId' => $era->EraId, 'BeginYearId' => $eraBeginYear, 'EndYearId' => $eraEndYear]);
            }

        } catch (\Exception $e) {
			DB::rollback();
        }
        DB::commit();
    }

    public function postDeleteEra(Request $request) {
        //Get Category ID and changing data
        $id = $request->EraId;

        try{

            DB::beginTransaction();

            DB::table('tblEra_BeginEnd')
                ->where('EraId',$id)
                ->delete();

            $era = Era::find($id);
            $era->delete();

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(Array('result'=>false, 'msg'=>'Deleted failed!!'));
        }
        DB::commit();

        return response()->json(Array('result'=>true, 'msg'=>'Successfully Deleted!!'));
    }

    public function getEraYears() {
        // Under is code for PostGreSQL database
//        $years = EraYear::select(
//            DB::raw('replace(replace(CAST("IsBC" AS TEXT), \'false\', \'AD\'), \'true\', \'BC\') || \' \' || "Year" AS "Year", "Era_YearId"'))
//            ->lists('Year','Era_YearId');

        $years = EraYear::select(
            DB::raw(' CONCAT( if(IsBC,\'BC\', \'AD\'), \' \', Year ) AS Year, Era_YearId'))
            ->lists('Year','Era_YearId');
        return response()->json($years);
    }

}
