<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\TinTuc;

class CartController extends Controller
{
    //
    public function getAddCart($id){
        $tintuc = TinTuc::find($id);
        Cart::add(['id'=>$id,
        'name'=>$tintuc->TieuDe,
        'qty'=>1,
        'price'=>0,
        'options'=>['img'=>$tintuc->Hinh]
        ]);
        return redirect('cart/show');
    }
    public function getShowCart(){
        $data['item'] = Cart::content();
        return view('pages.cart',$data);
    }
    public function getDeleteCart($id){
        if($id=='all'){
            Cart::destroy();
        }else{
           Cart::remove($id);
        }
        return back();
    }
}
