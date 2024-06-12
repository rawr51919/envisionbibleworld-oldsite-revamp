<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quotation;
use App\StatusType;
use Illuminate\Http\Request;

class QuotationController extends Controller
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
        return view('quotation.index');
    }

    public function getQuotation(Request $request)
    {
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

        $count = Quotation::all()->count();
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

        $quotation = Quotation::leftJoin('tblStatusType', 'tblQuotation.StatusTypeId', '=', 'tblStatusType.StatusTypeId')
            ->select('tblQuotation.QuotationId', 'tblQuotation.Quotation', 'tblQuotation.StatusTypeId', 'tblStatusType.StatusType', 'tblQuotation.EntryDate')
            ->skip($start)->take($limit)
            ->orderBy($sidx, $sord)
            ->get();
        $res = array('page' => $page, 'total' => $total_pages, 'records' => $count, 'rows' => $quotation);
        return response()->json($res);
    }

    public function postUpdateQuotation(Request $request)
    {
        // Get quotationid and editables
        $id = $request->QuotationId;

        //Get Quotation stuff
        try {
            if (is_numeric($id)) {
                $quotation = Quotation::find($id);
                $quotation->Quotation = $request->Quotation;
                $quotation->StatusTypeId = $request->StatusType;
                $quotation->save();
            } else {
                $quotation = new Quotation;
                $quotation->Quotation = $request->Quotation;
                $quotation->StatusTypeId = $request->StatusType;
                $quotation->save();
            }
        } catch (\Exception $e) {
            return response()->json(array('result' => false, 'msg' => 'Add new quotation failed!!'));
        }
        return response()->json(array('result' => false, 'msg' => 'Successfully save new quotation!!'));
    }

    /***
     * Delete quotation by ajax.
     * @param Request $request
     */
    public function postDeleteQuotation(Request $request)
    {
        // Get quotationid and editables
        $id = $request->QuotationId;
        //Get Quotation stuff
        $quotation = Quotation::find($id);
        try {
            $quotation->StatusTypeId = 4;
            $quotation->save();
        } catch (\Exception $e) {
            return response()->json(array('result' => false, 'msg' => 'Delete failed!!'));
        }
        return response()->json(array('result' => true, 'msg' => 'Successfully Deleted!!'));
    }


    public function getStatusTypes()
    {

        $categories = StatusType::lists('StatusType', 'StatusTypeId');

        return response()->json($categories);
    }
}
