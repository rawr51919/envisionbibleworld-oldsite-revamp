<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Category;
use Illuminate\Session;

class CategoryController extends Controller
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
        return view('category.index');
    }

    public function getCategories()
    {
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

        // $fields = explode(', ', $sidx.''.$sord); (unused for now)

        $count = Category::all()->count();
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

        $categories = Category::orderBy('CategoryId')
            ->skip($start)
            ->take($limit)
            ->orderBy($sidx, $sord)
            ->get();

        $res = array('page' => $page, 'total' => $total_pages, 'records' => $count, 'rows' => $categories);
        return response()->json($res);
    }

    public function getPublicCategories()
    {
        return Category::select('Category')->toArray();
    }

    public function postUpdateCategory(Request $request)
    {
        //Get Category ID and changing data
        $id = $request->CategoryId;

        //Get Summary_Details data to get summaryId and quotationId

        try {
            if (is_numeric($id)) {
                $category = Category::find($id);
                $category->Category = $request->Category;
                $category->Explanation = $request->Explanation;
                $category->save();
            } else {
                $newCategory = new Category();
                $newCategory->Category = $request->Category;
                $newCategory->Explanation = $request->Explanation;
                $newCategory->save();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('result' => false, 'msg' => 'Update failed!!'));
        }
        DB::commit();
        return response()->json(array('result' => true, 'msg' => 'Successfully Updated!!'));
    }

    public function postUpdateSubcategory(Request $request)
    {
        //Get Category ID and changing data
        $id = $request->id;

        //Get Summary_Details data to get summaryId and quotationId

        try {
            if (is_numeric($id)) {
                $subcategory = SubCategory::find($id);
                $subcategory->Subcategory = $request->Subcategory;
                $subcategory->Subcategory_Explanation = $request->Subcategory_Explanation;
                $subcategory->StatusTypeId = $request->StatusType;
                $subcategory->save();
            } else {
                $newSubCategory = new SubCategory();
                $newSubCategory->Subcategory = $request->Subcategory;
                $newSubCategory->CategoryId = $request->categoryId;
                $newSubCategory->Subcategory_Explanation = $request->Subcategory_Explanation;
                $newSubCategory->StatusTypeId = $request->StatusType;
                $newSubCategory->save();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('result' => false, 'msg' => 'Update failed!!'));
        }
        DB::commit();
        return response()->json(array('result' => true, 'msg' => 'Successfully Updated!!'));
    }

    public function postDeleteCategory(Request $request)
    {
        //Get Category ID and changing data
        $id = $request->id;

        try {

            DB::beginTransaction();

            $category = Category::find($id);
            $category->delete();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('result' => false, 'msg' => 'Delete failed!!'));
        }
        DB::commit();
        return response()->json(array('result' => true, 'msg' => 'Successfully Deleted!!'));
    }

    public function postDeleteSubcategory(Request $request)
    {
        //Get Category ID and changing data
        $id = $request->id;

        try {

            DB::beginTransaction();

            $subcategory = SubCategory::find($id);
            $subcategory->delete();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('result' => false, 'msg' => 'Delete failed!!'));
        }
        DB::commit();
        return response()->json(array('result' => true, 'msg' => 'Successfully Deleted!!'));
    }

    public function getSubcategories(Request $request)
    {
        $id = $request->rowId;

        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

        // $fields = explode(', ', $sidx.''.$sord); (unused for now)

        $count = SubCategory::where('CategoryId', '=', $id)->count();
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

        $subcategories = SubCategory::leftJoin('tblStatusType', 'tblSubCategory.StatusTypeId', '=', 'tblStatusType.StatusTypeId')
            ->select(
                'tblStatusType.StatusType',
                'tblSubCategory.StatusTypeId',
                'tblSubCategory.SubcategoryId',
                'tblSubCategory.Subcategory',
                'tblSubCategory.Subcategory_Explanation',
                'tblSubCategory.CategoryId'
            )
            ->where('CategoryId', '=', $id)
            ->skip($start)
            ->take($limit)
            ->orderBy($sidx, $sord)
            ->get();

        $res = array('page' => $page, 'total' => $total_pages, 'records' => $count, 'rows' => $subcategories);
        return response()->json($res);
    }
}
