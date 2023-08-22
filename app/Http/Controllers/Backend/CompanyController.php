<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    // company index
    public function allCompany()
    {
        $companies = Company::latest()->paginate(5);
        return view('admin.company.index',compact('companies'));
    }

    // data insert start

    public function addCompany(Request $request)
    {
        // custom validactdion
        // return $request->all();
        $validatedData = $request->validate([
            'company_name' => ['required','min:4', 'max:255'],
            'company_image' => ['required','mimes:png,jpg,jpeg'],
        ],
        [
            'company_name.required' => 'please input  Company name',
            'company_name.max' => 'please input  max 255 chart',
            'company_image.required' => 'please input Company Image',
            'company_image.mimes' => 'please input Company Image jpg formate',
        ]);

        $company_image = $request->file('company_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($company_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'img/company/';
        $last_img = $up_location.$img_name;
        $company_image->move($up_location,$img_name);

        Company::insert([
            'company_name' => $request->company_name,
            'user_id' => Auth::user()->id,
            'company_image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        return redirect()->back()->with('success','Company image Inserted');
    }
       // data insert end

    //    edit start
    public function editcompany($id)
    {
        $company= Company::find($id);
        return view('admin.company.edit',compact('company'));
    }
    // edit end
    // update start

    public function updateCompany(Request $request , $id)
    {
        $old_img = $request->old_img;
        // validaction logic start
        $company_image = $request->file('company_image');
        $company_name = $request->company_name;
        if($company_image && $company_name ){

             $validatedData = $request->validate([
            'company_name' => ['required','min:4', 'max:255'],
            'company_image' => ['required','mimes:png,jpg,jpeg'],

        ],
        [
            'company_name.required' => 'please input  Company name',
            'company_name.max' => 'please input  max 255 chart',
            'company_image.required' => 'please input Company Image',
            'company_image.mimes' => 'please input Company Image jpg formate',
        ]);
        }elseif($company_name || empty($company_name)){

            $validatedData = $request->validate([
                'company_name' => ['required','min:4', 'max:255'],

            ],
            [
                'company_name.required' => 'please input  Company name',
                'company_name.max' => 'please input  max 255 chart',
                'company_image.required' => 'please input Company Image',
                'company_image.mimes' => 'please input Company Image jpg formate',
            ]);

        }elseif($company_image){

            $validatedData = $request->validate([
                'company_image' => ['required','mimes:png,jpg,jpeg'],

            ],
            [
                'company_name.required' => 'please input  Company name',
                'company_name.max' => 'please input  max 255 chart',
                'company_image.required' => 'please input Company Image',
                'company_image.mimes' => 'please input Company Image jpg formate',
            ]);

             // validaction logic end
        }

        if($company_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($company_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'img/company/';
            $last_img = $up_location.$img_name;
            $company_image->move($up_location,$img_name);
            unlink($old_img);

            Company::find($id)->update([

                'company_name' => $request->company_name,
                'user_id' => Auth::user()->id,
                'company_image' => $last_img,
                'created_at' => Carbon::now()
            ]);
            // return redirect()->back()->with('success','Company updated');
            return redirect()->route('all.company')->with('success','Company updated');
        }
        else{
            
            Company::find($id)->update([

                'company_name' => $request->company_name,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now()
            ]);
            // return redirect()->back()->with('success','Company updated');
            return redirect()->route('all.company')->with('success','Company updated');
        }
    }
    // update end

    // delete company start
    public function companyDelete($id){
        $img = Company::find($id);
        $old_image = $img->company_image;
        unlink($old_image);
        Company::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Company Deleted');
    }

    // delete company end


}
