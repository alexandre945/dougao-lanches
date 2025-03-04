<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PromotionController extends Controller
{
    public function show( Request $request)
     {
       $product = Product::where('category_id', 5)->get();
       return view('products.showPromotion', compact('product'));
     }

     public function update(Request $request, $id)
       {
        $product = Product::findOrFail($id);
         $data = $request->all();
         if(isset($data['price'])){
            $data['price'] = str_replace(',','.', $data['price']);
          $product->update($data);  
         }
      
        return redirect()->back()->with('success', 'Promoção atualizada com sucesso');
       }

      public function delete(Request $request, $id)
        {
            $product = Product::findOrFail($id);
            $product->delete($request->all());
            return redirect()->back()->with('delete', 'Promoção deletada com sucesso');

        }   
}
