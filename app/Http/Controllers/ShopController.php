<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    function index(){
        // dd(112);
        return view('shop.form');
    }
    function store(Request $request){
      // if($request->update_id){
      //    $shop  = Shop::find($request->update_id);
      // }
   
      
      if($request->id == null){
         $shop = new Shop();
         $shop->name = $request->name;
         $shop->address = $request->address;
         $shop->email = $request->email;
      }
      else
      {
         $shop = new Shop();
         $shop->exists=true;
         $shop->id = $request->id;
       $shop->name = $request->name;
       $shop->address = $request->address;
       $shop->email = $request->email;
      }
      $shop->save();
      
       return json_encode([
          'success'=>$shop,
       ]);
    }
      function show(){
        // dd(123);
        $shop = Shop::all();
        $html = view('shop.table',compact('shop'))->render();
        //  dd($html);
        return json_encode([
            'table'=>$html,
         ]);
      }
      function destroy(Request $request){
        
         $shop = Shop::find($request->id);
         $shop->delete();
         return json_encode([
           'success'=>true,
         ]);
      }
      function edit(Request $request){
         $shop = shop::find($request->id);

         return json_encode([
           'success'=>true,
           'data' => $shop
         ]);
      }
}
