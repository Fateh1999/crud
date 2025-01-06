<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){   
        return view('products.index', ['products' => Product::get()]);
    }
    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        //validation
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);


        //upload data
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);
        
        $product = new Product;
        $product->image = $imageName;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();
        return redirect()->route ('products.index')->withSuccess('Successfully created');
        // return back()->withSuccess('Successfully created')->withSuccess('Successfully created');
    }

    public function edit($id){
        $product = Product::where('id', $id)->first();
        return view('products.edit',['product' => $product]);
    }

    public function update(Request $request, $id){
        //validation
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable',
        ]);

        $product = Product::where('id', $id)->first();

        if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }


        //upload data
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        // return redirect()->route ('products.index');
        return back()->withSuccess('Successfully updated');

    }

    public function destroy($id){
        $product = Product::where('id', $id)->first();
         $image_path  = public_path('products/'.$product->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $product->delete();

        return back()->withSuccess('Successfully deleted');

    }

    public function show($id){
        $product = Product::where('id', $id)->first();

        return view('products.show',['product' => $product]);
    }
}   
