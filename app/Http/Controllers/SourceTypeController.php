<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SourceType;
use Illuminate\Http\Request;

class SourceTypeController extends Controller {

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
        return view('sourcetype.index');
    }

    public function getSourceTypes() {

        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

        $count = SourceType::all()->count();
        if ($count > 0 && $limit > 0) {
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

        $sourceTypes = SourceType::skip($start)->take($limit)
            ->orderBy($sidx, $sord)
            ->get();

        $res = array('page'=>$page,'total'=>$total_pages, 'records'=>$count, 'rows'=>$sourceTypes);
        return response()->json($res);
    }

    public function postUpdateSourceType(Request $request) {
        //Get Category ID and changing data
        $id = $request->Source_TypeId;
        $sourceType = $request->Source_Type;
        $sourceTypeAbbreviation = $request->Source_Type_Abbreviation;

        try{
            if(is_numeric($id)) {
                $obj = SourceType::find($id);
                $obj->Source_Type = $sourceType;
                $obj->Source_Type_Abbreviation = $sourceTypeAbbreviation;
                $obj->save();
            }else{
                $obj = new SourceType;
                $obj->Source_Type = $sourceType;
                $obj->Source_Type_Abbreviation = $sourceTypeAbbreviation;
                $obj->save();
            }

        } catch (\Exception $e) {
            return response()->json(array('result'=>false, 'msg'=>'Save failed!!'));
        }
        return response()->json(array('result'=>true, 'msg'=>'Successfully saved!!'));
    }

    public function postDeleteSourceType(Request $request) {
        //Get Category ID and changing data
        $id = $request->Source_TypeId;
        try{

            $obj = SourceType::find($id);
            $obj->delete();

        } catch (\Exception $e) {
            return response()->json(array('result'=>false, 'msg'=>'Deleted failed!!'));
        }

        return response()->json(array('result'=>true, 'msg'=>'Successfully Deleted!!'));
    }

}
