<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //

    public function Allcat() {
        //  eloquent
        // $categories = Category::all();
        $categories = Category::latest()->paginate(5);

        // query builder

        // $categories = DB::table('categories')->latest()->get();

        // $categories = DB::table('categories')
        // ->join('users', 'categories.user_id', 'users.id')
        // ->select('users.name', 'categories.*')
        // ->latest()->paginate(5);

        return view('admin.category.index', compact('categories'));
    }


    public function AddCat(Request $request) {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|min:3',
            
        ],

        [
            'category_name.required' => 'Please input category name',
            'category_name.min' => 'It must be more than 5 characters.'
        ]
    );
// eloquent orm 
        Category::insert([

            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;

        // $category->save();

        // Query builder

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;

        // DB::table('categories')->insert($data);


        return Redirect()->back()->with('success', 'Category inserted successfully');

    }

    public function Edit($id) {
        $categories = Category::findOrFail($id);

        return view('admin.category.edit', compact('categories'));
    }

    public function Update(Request $request, $id) {

        $categories = Category::findOrFail($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);

        return Redirect()->route('all.category')->with('success', 'Category updated successfully');
    }
}
