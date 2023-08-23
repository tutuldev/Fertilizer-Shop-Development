<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function allBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

    // store brand

    public function addBrand(Request $request)
    {
        // custom validactdion
        // return $request->all();
        //   return $last_img;

        $validatedData = $request->validate([
            'brand_name' => ['required','min:4', 'max:255'],
            'brand_image' => ['required','mimes:png,jpg,jpeg'],

        ],
        [
            'brand_name.required' => 'please input  brand name',
            'brand_name.max' => 'please input  max 255 chart',
            'brand_image.required' => 'please input Brand Image',
            'brand_image.mimes' => 'please input Brand Image jpg formate',
        ]);



        // data insert
        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'img/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);

        Brand::insert([

            'brand_name' => $request->brand_name,
            'user_id' => Auth::user()->id,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        // return $last_img;
        // return $brand_name;
        // return $request->all();
        return redirect()->back()->with('success','Brand_image Inserted');


    }

    public function editBrand($id)
    {
        $brand= Brand::find($id);
        // $categories = Category::latest()->paginate(5);
        return view('admin.brand.edit',compact('brand'));
    }

    public function updateBrand(Request $request , $id)
    {
        $old_img = $request->old_img;
        // validaction logic start
        $brand_image = $request->file('brand_image');
        $brand_name = $request->brand_name;
        // $empty_brand_name =$request->brand_name;
        // return  $brand_name;
        // && empty($brand_name)

        if($brand_image && $brand_name ){

             $validatedData = $request->validate([
            'brand_name' => ['required','min:4', 'max:255'],
            'brand_image' => ['required','mimes:png,jpg,jpeg'],

        ],
        [
            'brand_name.required' => 'please input  brand name',
            'brand_name.max' => 'please input  max 255 chart',
            'brand_image.required' => 'please input Brand Image',
            'brand_image.mimes' => 'please input Brand Image jpg formate',
        ]);



        }elseif($brand_name || empty($brand_name)){

            $validatedData = $request->validate([
                'brand_name' => ['required','min:4', 'max:255'],
                // 'brand_image' => ['required','mimes:png,jpg,jpeg'],

            ],
            [
                'brand_name.required' => 'please input  brand name',
                'brand_name.max' => 'please input  max 255 chart',
                'brand_image.required' => 'please input Brand Image',
                'brand_image.mimes' => 'please input Brand Image jpg formate',
            ]);


        }elseif($brand_image){

            $validatedData = $request->validate([
                // 'brand_name' => ['required','min:4', 'max:255'],
                'brand_image' => ['required','mimes:png,jpg,jpeg'],

            ],
            [
                'brand_name.required' => 'please input  brand name',
                'brand_name.max' => 'please input  max 255 chart',
                'brand_image.required' => 'please input Brand Image',
                'brand_image.mimes' => 'please input Brand Image jpg formate',
            ]);

             // validaction logic end
        }

        if($brand_image){

            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'img/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location,$img_name);
            unlink($old_img);

            Brand::find($id)->update([

                'brand_name' => $request->brand_name,
                'user_id' => Auth::user()->id,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);
            return redirect()->back()->with('success','Brand updated');

        }
        else{
            Brand::find($id)->update([

                'brand_name' => $request->brand_name,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now()
            ]);
            return redirect()->back()->with('success','Brand updated');
        }



    }

    public function brandDelete($id){
        $img = Brand::find($id);
        $old_image = $img->brand_image;
        unlink($old_image);
        // print_r($old_image);
        // die();
        Brand::withTrashed()->find($id)->forceDelete();
        // return redirect()->back()->with('success','Brand Deleted');
        return redirect()->route('all.brand')->with('success','Brand Deleted');
    }

}
