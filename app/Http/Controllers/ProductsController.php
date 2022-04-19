<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    protected $temp = '';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = product::count();
        if (request()->has('txtSearch')) {
            // $products = product::where('name', 'like', '%' . request()->txtSearch . '%')->orWhere('price', 'like', '%' . request()->txtSearch . '%')->paginate(4);
            $products = product::latest()->where(request()->searchBy, 'like', '%' . request()->txtSearch . '%')->orderBy(request()->searchBy, request()->sort ?? 'asc')->paginate(request()->perpage ?? '5');
            return view('products.ProductsTable', compact('products', 'items'))->render();
        } else {
            $products = product::latest()->paginate(request()->perpage ?? '5');
        }
        Session::put('urlData', request()->fullUrl());
        //echo 'Session Data: ' . Session::get('urlData');
        return view('products.index', compact('products', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id','name')->get();
        // dd($categories);
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            ['name' => 'required|max:100', 'image' => 'required|image|mimes:png,jpg', 'desc' => 'required', 'price' => 'required|numeric', 'discount' => 'required|numeric', 'category_id' => 'required']
        );
        $imageName = rand() . '_' . rand() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/images'), $imageName);
        $item = product::create([
            'name' => $request->name,
            'image' => $imageName,
            'desc' => $request->desc,
            'price' => $request->price,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
        ]);
        if ($item)
            return redirect()->back()->with('msg', 'Product was added successfully')->with('icon', 'success');
        else
            return redirect()->back()->with('msg', 'Product was not added successfully')->with('icon', 'error');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Category::select('id','name')->get();
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product', 'categories'));
        // if(!$prod){
        //     abort(404);
        // }else{
        //     dd($prod->name);
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|max:100', 
                'image' => 'nullable|image|mimes:png,jpg', 
                'desc' => 'required', 
                'price' => 'required|numeric', 
                'discount' => 'required|numeric', 
                'category_id' => 'required'
        ]);
        $product = product::findOrFail($id);
        $imageName = $product->image;
        if($request->has('image')){

            if ($imageName && file_exists(public_path('uploads/images/') . $imageName))
                File::delete(public_path('uploads/images/' . $imageName));

            $imageName = rand() . '_' . rand() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/images'), $imageName);
        }
        $item = $product->update([
            'name' => $request->name,
            'image' => $imageName,
            'desc' => $request->desc,
            'price' => $request->price,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
        ]);
        if ($item)
            return redirect()->back()->with('msg', 'Product was updated successfully')->with('icon', 'success');
        else
            return redirect()->back()->with('msg', 'Product was not updated successfully')->with('icon', 'error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //product::destroy($id);

        $product = product::find($id);
        $imageName = $product->image;
        if ($imageName && file_exists(public_path('uploads/images/') . $imageName))
            File::delete(public_path('uploads/images/' . $imageName));
        $product->delete();
        // if (Session::get('urlData'))
        //     return redirect(Session::get('urlData'))->with('msg', 'Product has been deleted successfully');
        // else
        //     return redirect()->route('products.index')->with('msg', 'Product has been deleted successfully');
        return 'Row was deleted successfully';
    }

    public function showmsg()
    {
        return 'This is my controller!';
    }
}
