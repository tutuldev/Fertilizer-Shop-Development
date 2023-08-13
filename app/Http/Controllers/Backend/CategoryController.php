<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function allChategory()
    {
        // $categories = Category::all();
        // $categories = Category::latest()->get();
        $trashCategories =  Category::onlyTrashed()->latest()->paginate(10);
        $categories = Category::latest()->paginate(5);
        return view('admin.category.index',compact('trashCategories','categories'));
    }
    public function addChategory(Request $request)
    {
        // custom validactdion
        $validatedData = $request->validate([
            'category_name' => ['required', 'max:255'],
        ],
        [
            'category_name.required' => 'please input  category name',
            'category_name.max' => 'please input  max 255 chart',
        ]);

        // difult
        // $validatedData = $request->validate([
        //     'category_name' => ['required', 'max:255'],
        // ]);

        // data insert 1
        $category = Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
        return redirect()->back()->with('success','Category Inserted');

        // data insert 2
            // $category = new Category;
            // $category ->category_name= $request->category_name;
            // $category ->user_id= Auth::user()->id;
            // $category ->save();
    }
    public function editCategory($id)
    {
        $category= Category::find($id);
        // $categories = Category::latest()->paginate(5);
        return view('admin.category.edit',compact('category'));
    }

    public function updateCategory(Request $request,$id)
    {
        $update = Category::find($id)->update([

            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('all.category')->with('success','Category Updated');
    }

    // soft delete

    public function softDelete($id)
    {
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success','Category Deleted');
    }

    // restore category

    public function restoreCategory($id)
    {
        $delete = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Category restore');
    }

    public function prmDelete($id)
    {
        $delete = Category::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Category Parmanent Deleted');
        
    }

}
