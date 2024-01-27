<?php

namespace App\Http\Controllers\Apis;

use App\Models\brand;
use App\Models\Product;
use App\Http\traits\media;
use App\Models\Subcategory;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        //bageb table el products mn el db f 3malt model product
        //w 3malt variable hatet feh model el product w all btgeb kol el products
        $products= Product::all();
         //f barg3ha k json btakhod mny 2 parameters el data ely brg3ha w el status ely hya rag3a auto b 200 y3ny success
         //bs hena by2blha mny k array el data ely rag3a w el product ely fo2 da variabel f hn3ml compact 3lshan a7awel el product k array w armeha hena
         //f el key bt3ha esmo products w el value hya el array
        return response()->json(compact('products'));
        //el output ely reg3 mn el response hwa object wahed w shayel key
        //esmo products w gwaha array of obhects shayla el products kolha
    }
    //fe saf7t el create yb3tly request harod b json respond  ely hya el brand w el subcategories
    //f 3amlna 2 models brands w el subcategory

    public function create()
    {
        $brands= Brand::all();
        $subcategories=Subcategory::select('id','name_en')->get();//est3mlt el query builder
        return response()->json(compact('brands','subcategories'));

    }
    //fe el edit b2a el saf7a de 3lshan ttft7 lazm apis feh inputs lazm yb3thaly 3lshan arod 3leh b bynat el montag
    //w el inputs hena hya el id 3lshan a3rf anhy montag ely ha3ml edit 3leh
    //bs hena hykon feh ekhtlaf fe el status aw el response

    public function edit($id)//gayely route parameter ely hwa el id f lazm asr2belo k parameter
    {
       //mehtaga adwar 3la el id fe el db
       //men el model el mas2ol ely hadwar 3leh fe el db hwa el products
       //f hast3en bl query builder 3lshan a3ml condition ely hwa el array_where f ha2olo where el id da equal el id ely gayely f hastkhdm first msh get 3lshan hwa product wahed bs f 3yzah yrg3holy k object
       //lakn get btrg3holy k array of object
       //$product= Product::where('id',$id)->first();
       //w momkn tare2a tanya bastkhdm method esmo find badl where w badelo el id ely 3yza adwar 3leh
      
       $products=Product::findOrFail($id);
       $brands= Brand::all();
       $subcategories=Subcategory::select('id','name_en')->get();
       return response()->json(compact('products','brands','subcategories'));
       //bs lazm a3ml validate 3la el id abl m a3ml find f hstkhdm findorfail hena laravel b validate lwahdo
    }
    public function store(StoreProductRequest $request)
    {
        $photoName=$this->uploadPhoto($request->image,'products');
        //insert
        $data=$request->except('image');
        $data['image']=$photoName;
        //create product bl eloquonte
        $product=Product::create($data);
        return response()->json(['success'=> true,'messag'=>"product created successfully"]);   
    }

    public function update(UpdateProductRequest $request,$id)
    {
         //nkhzn image in db
         $data=$request->except('image');
         if($request->has('image')){
            //hms7 el adema el awl
            $oldphotoName=Product::find($id)->image;
            $this->deletePhoto(public_path('dist/img/products/'.$oldphotoName));
            // $photoName=uniqid(). '.'.$request->image->extension();
            // $request->image->move(public_path('/dist/img/products'),$photoName);
            $photoName=$this->uploadPhoto($request->image,'products');
            $data['image']=$photoName;
         }
         //update product into db
         Product::where('id',$id)->update($data);
         return response()->json(['success'=> true,'message'=>"product updated successfully"]);
        }

        public function destroy($id)
        {
               //delete photo
                $oldphotoName=Product::find($id)->image;
               
                $this->deletePhoto(public_path('dist/img/products/'.$oldphotoName));
                //delete product bystkhdm el query builder
                Product::where('id',$id)->delete();
                return response()->json(['success'=> true,'message'=>"product deleted successfully"]);
    
        }
}
