<?php

namespace App\Http\Controllers;

use Validator;
use App\ApiBaseMethod;
use App\SmItemCategory;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmItemCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemCategories = SmItemCategory::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($itemCategories, null);
        }
        return view('backEnd.inventory.itemCategoryList', compact('itemCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'category_name' => "required|unique:sm_item_categories,category_name"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $categories = new SmItemCategory();
        $categories->category_name = $request->category_name;
        $results = $categories->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null, 'New Category has been added successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($results) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $editData = SmItemCategory::find($id);
        $itemCategories = SmItemCategory::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['editData'] = $editData->toArray();
            $data['itemCategories'] = $itemCategories->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.inventory.itemCategoryList', compact('itemCategories', 'editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'category_name' => "required|unique:sm_item_categories,category_name," . $id,
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $categories = SmItemCategory::find($id);
        $categories->category_name = $request->category_name;
        $results = $categories->update();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null, 'Category has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($results) {
                Toastr::success('Operation successful', 'Success');
                return redirect('item-category');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteItemCategoryView(Request $request, $id)
    {


        $title = "Are you sure to detete this Item category?";
        $url = url('delete-item-category/' . $id);
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($id, null);
        }
        return view('backEnd.modal.delete', compact('id', 'title', 'url'));
    }

    public function deleteItemCategory(Request $request, $id)
    {



        $tables = \App\tableList::getTableList('item_category_id');
        try {
            $result = SmItemCategory::destroy($id);
            if ($result) {

                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    if ($result) {
                        return ApiBaseMethod::sendResponse(null, 'Item Category has been deleted successfully');
                    } else {
                        return ApiBaseMethod::sendError('Something went wrong, please try again.');
                    }
                } else {
                    if ($result) {
                        Toastr::success('Operation successful', 'Success');
                        return redirect()->back();
                    } else {
                        Toastr::error('Operation Failed', 'Failed');
                        return redirect()->back();
                    }
                }
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Illuminate\Database\QueryException $e) {

            $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
            return redirect()->back()->with('message-danger-delete', $msg);
        } catch (\Exception $e) {
            //dd($e->getMessage(), $e->errorInfo);
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
