<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Publisher;
use App\SourceDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Source;
use Yajra\Datatables\Facades\Datatables;
use App\StatusType;
use App\SourceType;
class SourceController extends Controller {


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
		return view('source.index');
	}

    public function getSources() {

		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sidx = 'SourceId';
		$sord = $_GET['sord'];

		$fields = explode(', ', $sidx.''.$sord);

		$count = Source::all()->count();
		if( $count > 0 && $limit > 0) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}

		if ($page > $total_pages)
			$page = $total_pages;


		$start = $limit * $page - $limit;
		if($start < 0) $start = 0;

		$sources = Source:://leftJoin('tblStatusType', 'tblSource.StatusTypeId', '=', 'tblStatusType.StatusTypeId')
			/*->*/leftJoin('tblSource_Type', 'tblSource.Source_TypeId', '=', 'tblSource_Type.Source_TypeId')
//			->leftJoin('tblPublisher', 'tblSource.PublisherId', '=', 'tblPublisher.PublisherId')
			->select('tblSource.SourceId',
				'tblSource.Source_TypeId',
				'tblSource.SourceName',
//				'tblSource.StatusTypeId',
				'tblSource.LastChptrOrSection',
//				'tblSource.ChptrOfLastVrs',
//				'tblSource.LastVerseOrPage',
//				'tblSource.ScreenShotName',
//				'tblSource.PublisherId',
//				'tblSource.EntryDate',
//				'tblStatusType.StatusType',
				'tblSource_Type.Source_Type_Abbreviation'//,
//				'tblPublisher.PublisherName'
			)
			->skip($start)->take($limit)
			->orderBy($sidx, $sord)
			->get();

		//$sources = Source::orderBy('SourceId')->get();

		//return json_encode($sources);

		$res = Array('page'=>$page,'total'=>$total_pages, 'records'=>$count, 'rows'=>$sources);
		return response()->json($res);
    }


	
	public function postDeleteSource(Request $request) {
		$id = $request->SourceId;
		try{

			DB::beginTransaction();

			$source = Source::find($id);
			$source->delete();

		} catch (\Exception $e) {
			DB::rollback();
			return response()->json(Array('result'=>false, 'msg'=>'Deleted failed!!'));
		}
		DB::commit();

		return response()->json(Array('result'=>true, 'msg'=>'Successfully Deleted!!'));
	}

	public function postUpdateSource(Request $request) {
		//Get Category ID and changing data
		$id = $request->SourceId;


		try{
			if(is_numeric($id)) {
				$source = Source::find($id);
				$source->SourceName = $request->SourceName;
				$source->Source_TypeId = $request->Source_Type_Abbreviation;
				$source->LastChptrOrSection = $request->LastChptrOrSection;
				$source->save();
			} else {
				$newSource = new Source();
				$newSource->SourceName = $request->SourceName;
				$newSource->Source_TypeId = $request->Source_Type_Abbreviation;
				$newSource->LastChptrOrSection = $request->LastChptrOrSection;
				$newSource->save();
			}
		} catch (\Exception $e) {

		}
	}

	public function getStatusTypes() {

		$statustypes = StatusType::lists('StatusType', 'StatusTypeId');

		return response()->json($statustypes);
	}

	public function getPublishers() {
		$publishers = Publisher::lists('PublisherName', 'PublisherId');

		return response()->json($publishers);
	}

	public function getSourceTypes() {

		$sourcetypes = SourceType::lists('Source_Type_Abbreviation','Source_TypeId');

		return response()->json($sourcetypes);
	}

	public function getSourceDetails(Request $request) {
		$id = $request->rowId;

		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sidx = 'Source_DetailId';
		$sord = $_GET['sord'];

		$fields = explode(', ', $sidx.''.$sord);

		$count = SourceDetail::where('SourceId', '=', $id)->count();
		if( $count > 0 && $limit > 0) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}

		if ($page > $total_pages)
			$page = $total_pages;


		$start = $limit * $page - $limit;
		if($start < 0) $start = 0;

		$sources = SourceDetail::leftJoin('tblStatusType', 'tblSource_Detail.StatusTypeId', '=', 'tblStatusType.StatusTypeId')
			->leftJoin('tblPublisher', 'tblSource_Detail.PublisherId', '=', 'tblPublisher.PublisherId')
			->select('tblSource_Detail.Source_DetailId',
				'tblSource_Detail.SourceId',
				'tblSource_Detail.StatusTypeId',
				'tblSource_Detail.ChptrOfLastVrs',
				'tblSource_Detail.LastVerseOrPage',
				'tblSource_Detail.ScreenShotName',
				'tblSource_Detail.PublisherId',
				'tblSource_Detail.EntryDate',
				'tblStatusType.StatusType',
				'tblPublisher.PublisherName'
			)
			->where('tblSource_Detail.SourceId', '=', $id)
			->skip($start)->take($limit)
			->orderBy($sidx, $sord)
			->get();

		//$sources = Source::orderBy('SourceId')->get();

		//return json_encode($sources);

		$res = Array('page'=>$page,'total'=>$total_pages, 'records'=>$count, 'rows'=>$sources);
		return response()->json($res);
	}

	public function postEditSourceDetail(Request $request) {
		$id = $request->id;


		try{
			if(is_numeric($id)) {
				$source = SourceDetail::find($id);
				$source->ChptrOfLastVrs = $request->ChptrOfLastVrs;
				$source->LastVerseOrPage = $request->LastVerseOrPage;
				$source->ScreenShotName = $request->ScreenShotName;
				if(!is_numeric($request->PublisherName))
					$source->PublisherId = null;
				else
					$source->PublisherId = $request->PublisherName;
				$source->StatusTypeId = $request->StatusType;
				$source->save();
			} else {
				$source = new SourceDetail();
				$source->SourceId = $request->rowId;
				$source->ChptrOfLastVrs = $request->ChptrOfLastVrs;
				$source->LastVerseOrPage = $request->LastVerseOrPage;
				$source->ScreenShotName = $request->ScreenShotName;
				if(!is_numeric($request->PublisherName))
					$source->PublisherId = null;
				else
					$source->PublisherId = $request->PublisherName;
				$source->StatusTypeId = $request->StatusType;
				$source->save();
			}
		} catch (\Exception $e) {

		}
	}

	public function postDeleteSourceDetail(Request $request) {
		$id = $request->id;

//		$sourcedetail = SourceDetail::find($id);
//
//		$sourcedetail->delete();
//		$sourcedetail->save();

		try{

			DB::beginTransaction();

			$sourcedetail = SourceDetail::find($id);
			$sourcedetail->delete();

		} catch (\Exception $e) {
			DB::rollback();
			return response()->json(Array('result'=>false, 'msg'=>'Deleted failed!!'));
		}
		DB::commit();

		return response()->json(Array('result'=>true, 'msg'=>'Successfully Deleted!!'));
	}

	public function postAddSourceDetail(Request $request) {

	}

}
