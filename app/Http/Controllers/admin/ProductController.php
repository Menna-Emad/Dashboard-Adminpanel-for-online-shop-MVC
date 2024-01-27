<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //4 methods (index,edit,create,destroy)
       use media;
    public function index()
    {
        //get all products
        //el products rag3a mn db de array of objects rag3a mn db shyla el products
        //el products de mehtaga tt3erd f hat pass ll view f ha7wlha l array b compact
        $products= DB::table('products')
            ->select('id', 'name_en','price','status','quantity','code','created_at')
            ->get();//get de zy fetch all btgeb el db fe array indexed shayla kza object
        //pass these data to products view

        return view('admin.products.index',compact('products'));
    }

    public function create()
    {
        $brands= DB::table('brands')->get();
        $categories= DB::table('categories')->select('id','name_en')->where('status',1)->get();
        $subcategories= DB::table('subcategories')->select('id','name_en')->where('status',1)->get();
        return view('admin.products.create',compact('brands','subcategories','categories'));
    }
//request el variable da instance mn el class request
//kda el variable request da shayl kol el byanat ely gatly mn post ely fe el form
//el variable request da datatype bta3to object 3lshan da instance mn class el request
    public function store(StoreProductRequest $request)
    {
        //fe method esmha all bt7awel el data ely rag3a fe array

        //fe e controller fe class asln request byt3aml m3 el request eza kan post aw get
        //ezay akhod mn el class request da object aktb esm el class fe store method w b3d kda esm el object
        //validation
        // $rules=[
        //        'name_en'=>['required','string','max:256','min:2'],
        //        'price'=>['required','numeric','max:99999.99','min:0.5'],
        //        'code'=>['required','integer','digits:5','unique:products,code'],
        //        'quantity'=>['nullable','integer','max:999','min:1'],
        //        'desc_en'=>['required','string'],
        //        'status'=>['required','integer','between:0,1'],
        //        'subcategory_id'=>['required','integer','exists:subcategories,id'],
        //        'brand_id'=>['required','integer','exists:brands,id'],
        //        'image'=>['required','max:1000','mimes:png,jpg,jpeg'],
        // ];
        // $request->validate($rules);
        //upload image
        // $photoName=uniqid(). '.'.$request->image->extension();
        // $request->image->move(public_path('/dist/img/products'),$photoName);
        //use trait ely 3mlnah
        $photoName=$this->uploadPhoto($request->image,'products');
        //insert
        $data=$request->except('_token','image','page');
        $data['image']=$photoName;
        DB::table('products')->insert($data);
        //redirect
        if($request->page=='back'){
            return redirect()->back()->with('success','operation success');

        }else{
            return redirect()->route('products.index');
        }
    }

    //flash message
    //data=>session
    //display
    //unset
    //badl kol da fe el native bstkhdm with() fe el laravel


//el id da rakm el id ely fe db da route parameter
    public function edit($id)
    {
        //el mafrod method el edit btst2bl el id aw yglha el id w takhod el id da tgeb el product bta3o mn el db
        //query builder b2a 3lshan ageb el id mn db
        //hata condition en tkon el id bta3o =id ely gay fe el parameter
        //get de bgtrg3 array of object f btrg3 array kbera bs ely rage3 object wahed bs ely hwa el product bta3 el id
        //f msh hnstkhdm get hnstkhdm first byrg3 object wahed
        //first bt return el data k object wahed
        $product=DB::table('products')->where('id',$id)->first();
        $brands= DB::table('brands')->get();
        $categories= DB::table('categories')->select('id','name_en')->where('status',1)->get();
        $subcategories= DB::table('subcategories')->select('id','name_en')->where('status',1)->get();
        return view('admin.products.edit',compact('product','brands','subcategories'));
    }

    public function update(UpdateProductRequest $request,$id)
    {
         //validation
    //      $rules=[
    //         'name_en'=>['required','string','max:256','min:2'],
    //         'price'=>['required','numeric','max:99999.99','min:0.5'],
    //         'code'=>['required','integer','digits:5',"unique:products,code,$id,id"],
    //         'quantity'=>['nullable','integer','max:999','min:1'],
    //         'desc_en'=>['required','string'],
    //         'status'=>['required','integer','between:0,1'],
    //         'subcategory_id'=>['required','integer','exists:subcategories,id'],
    //         'brand_id'=>['required','integer','exists:brands,id'],
    //         'image'=>['nullable','max:1000','mimes:png,jpg,jpeg'],
    //  ];
    //  $request->validate($rules);
         //nkhzn image in db
         $data=$request->except('_token','image','page');
         if($request->has('image')){
            //hms7 el adema el awl
            $oldphotoName=DB::table('products')->select('image')->where('id',$id)->first()->image;
            // if(file_exists(public_path('dist/img/products/'.$oldphotoName))){
            //     unlink(public_path('dist/img/products/'.$oldphotoName));
            // }
            $this->deletePhoto(public_path('dist/img/products/'.$oldphotoName));
            // $photoName=uniqid(). '.'.$request->image->extension();
            // $request->image->move(public_path('/dist/img/products'),$photoName);
            $photoName=$this->uploadPhoto($request->image,'products');
            $data['image']=$photoName;
         }
         //update product into db
         DB::table('products')->where('id',$id)->update($data);
    
         //redirect
         if($request->page){
            return redirect()->route('products.index')->with('success','operation success');

        }
    }

    public function destroy($id)
    {
           //delete photo
            $oldphotoName=DB::table('products')->select('image')->where('id',$id)->first()->image;
            // if(file_exists(public_path('dist/img/products/'.$oldphotoName))){
            //     unlink(public_path('dist/img/products/'.$oldphotoName));
            // } 
            $this->deletePhoto(public_path('dist/img/products/'.$oldphotoName));
            //delete product
            DB::table('products')->where('id',$id)->delete();
            return redirect()->route('products.index')->with('success','operation success');

    }
}
