<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=> $loaitin]);
    }
    public function getThem(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function postThem(Request $req){
        
        $this->validate($req,
        [
            'ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
            'theloai'=>'required'
        ],
        [
            'ten.required'=>'Ban chua nhap ten the loai',
            'ten.unique'=>'Ten da ton tai',
            'ten.min' => 'Ten phai trong khoaang tu 3-> 100',
            'theloai.required'=>'Khong duoc de trong'
        ]);
       
        $loaitin = new LoaiTin();
        $loaitin->Ten = $req->ten;
        $loaitin->idTheLoai = $req->theloai;
        $loaitin->TenKhongDau = changeTitle($req->ten);
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Them thanh cong');
    }
    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua', ['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $req, $id){
       
        $this->validate($req,
        [
            'ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
            'theloai'=>'required'
        ],
        [
            'ten.required'=>'Ban chua nhap ten the loai',
            'ten.unique'=>'Ten da ton tai',
            'ten.min' => 'Ten phai trong khoaang tu 3-> 100',
            'theloai.required'=>'Khong duoc de trong'
        ]);
        $loaitin = new LoaiTin();
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $req->ten;
        $loaitin->idTheLoai = $req->theloai;
        $loaitin->TenKhongDau = changeTitle($req->ten);
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa thanh cong');
    }
    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao', "Xoa thanh công");
    }
}
