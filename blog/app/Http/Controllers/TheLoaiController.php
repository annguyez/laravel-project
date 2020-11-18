<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach(){
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }
    public function getThem(){
        return view('admin.theloai.them');
        
    }
    public function postThem(Request $req){
        $this->validate($req,
        [
            'ten'=>'required|min:3|max:100'
        ],
        [
            'ten.required'=>'Ban chua nhap ten the loai',
            'ten.min' => 'Ten phai trong khoaang tu 3-> 100',
        ]);
        $theloai = new TheLoai();
        $theloai->Ten = $req->ten;
        $theloai->TenKhongDau = changeTitle($req->ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Them thanh cong');
    }
    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);

    }
    public function postSua(Request $req, $id){
        $theloai = TheLoai::find($id);
        $this->validate($req,
        [
            'ten'=>'required|unique:Theloai,Ten|min:3|max:100'
        ],
        [
            'ten.required'=>'Ban chua nhap ten the loai',
            'ten.unique'=>'Ten da ton tai',
            'ten.min' => 'Ten phai trong khoaang tu 3-> 100',
        ]);
        $theloai->Ten = $req->ten;
        $theloai->TenKhongDau = changeTitle($req->ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sua thanh cong');
    }
    public function getXoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','Xoa thanh cong');
    }
    public function getSearch($ten){
        $theloai = TheLoai::query();
        if ($request->has('ten')) {
            $theloai->where('Ten', 'LIKE', '%' . $request->ten . '%');
        }
        return $theloai->get();
    }
}
