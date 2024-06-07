<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SubCategory;
use App\Category;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class SubCategoryController extends Controller {

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
		$categories = Category::all();

		return view('subcategory.index', compact('categories'));
	}

	public function getSubcategories(Request $request) {
		$id = $request->CategoryId;


		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sord = $_GET['sord'];

		$fields = explode(', ', $sidx.''.$sord);

		$count = SubCategory::where('CategoryId', '=', $id)->count();
		if( $count > 0 && $limit > 0) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}

		if ($page > $total_pages)
			$page = $total_pages;


		$start = $limit * $page - $limit;
		if($start < 0) $start = 0;

		$subcategories = SubCategory::orderBy('SubcategoryId')->where('CategoryId', '=', $id)
			->skip($start)
			->take($limit)
			->orderBy($sidx, $sord)
			->get();

		//return json_encode($subcategories);

		$res = Array('page'=>$page,'total'=>$total_pages, 'records'=>$count, 'rows'=>$subcategories);
		return response()->json($res);
	}

	public function postDeleteSubcategory(Request $request) {
		//Get Category ID and changing data
		$id = $request->CategoryId;

		try{

			DB::beginTransaction();

			$subcategory = SubCategory::find($id);
			$subcategory->delete();

		} catch (\Exception $e) {
			DB::rollback();
			return response()->json(Array('result'=>false, 'msg'=>'Deleted failed!!'));
		}
		DB::commit();

		return response()->json(Array('result'=>true, 'msg'=>'Successfully Deleted!!'));
	}

	public function postUpdateSubcategory(Request $request) {
		//Get Category ID and changing data
		$id = $request->SubcategoryId;

		//Get Summary_Details data to get summaryId and quotationId

		try{
			if(is_numeric($id)) {
				$subcategory = SubCategory::find($id);
				$subcategory->Subcategory = $request->Subcategory;
				$subcategory->CategoryId = $request->CategoryId;
				$subcategory->Subcategory_Explanation = $request->Subcategory_Explanation;
				$subcategory->StatusTypeId = $request->StatusTypeId;
				$subcategory->save();
			}else{
				$newSubCategory = new SubCategory();
				$newSubCategory->Subcategory = $request->Subcategory;
				$newSubCategory->CategoryId = $request->CategoryId;
				$newSubCategory->Subcategory_Explanation = $request->Subcategory_Explanation;
				$newSubCategory->StatusTypeId = $request->StatusTypeId;
				$newSubCategory->save();
			}

		} catch (\Exception $e) {

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
		$category = Category::find($id);

		$categoryid = $category->CategoryId;

		return view('subcategory.show', compact('category'));
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
