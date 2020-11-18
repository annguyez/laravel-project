<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;

class SlideController extends Controller
{
    //
    public function getDanhSach(){
        $slide = Slide::all();
        return view('admin/slide/danhsach',['slide'=>$slide]);
    }
    public function getThem(){
        return view('admin/slide/them');
    }
    public function postThem(Request $req){
        $this->validate($req,
        [
            'ten'=> 'required|unique:Slide,Ten|min:3|max:100',
            'hinh'=>'required',
            'noidung'=>'required|min:3|max:100',
            'link'=>'required|min:3|max:100',
        ],
        [
            'ten.required'=>'Khong duoc de trong ten',
            'ten.unique'=>'Khong duoc dat trung ten',
            'ten.min'=>'Khong duoc it hon 3 ky tu',
            'ten.max'=>'Khong duoc nhieu hon 100 ky tư',
            'hinh.required'=>'Khong duoc de trong hinh',
            'noidung.required'=>'Khong duoc de trong noi dung',
            'link.required'=>'Khong duoc de trong link',
        ]
        );
        $slide = new Slide();
        $slide->Ten = $req->ten;
        $slide->Noidung = $req->noidung;
        $slide->link = $req->link;
        if($req->hasFile('hinh')){
            $file = $req->file('hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'png'){
                return redirect('admin/slide/them')->with('thongbaoloi','Moi ban nhap lai dinh dang anh');
            }
            $name = $file->getClientOriginalName();
            $hinh = Str_random(5)."_".$name;
            while(file_exists("upload/slide/".$hinh)){
                $hinh = Str_random(5)."_".$name;
            }
            $file->move("upload/slide",$hinh);
            $slide->Hinh = $hinh;
        }else{
            $req->Hinh ="";
        }
        $slide->save();
        return redirect('admin/slide/them')->with('success','Them slide thanh cong');
    }
    public function getSua($id){
        $slide = Slide::find($id);
        return view('admin/slide/sua', ['slide'=>$slide]);
    }
    public function postSua(Request $req, $id){
        $this->validate($req,
        [
            'ten'=> 'required|min:3|max:100',
            'hinh'=>'required',
            'noidung'=>'required|min:3|max:100',
            'link'=>'required|min:3|max:100',
        ],
        [
            'ten.required'=>'Khong duoc de trong ten',
            'ten.min'=>'Khong duoc it hon 3 ky tu',
            'ten.max'=>'Khong duoc nhieu hon 100 ky tư',
            'hinh.required'=>'Khong duoc de trong hinh',
            'noidung.required'=>'Khong duoc de trong noi dung',
            'link.required'=>'Khong duoc de trong link',
        ]
        );
        $slide = Slide::find($id);
        $slide->Ten = $req->ten;
        $slide->NoiDung = $req->noidung;
        $slide->link = $req->link;
        if($req->hasFile('hinh')){
            $file = $req->file('hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'png'){
                return redirect('admin/slide/sua/'.$id)->with('loi','Moi ban nhap dung dinh dang anh');
            }
            $name = $file->getClientOriginalName();
            $hinh = Str_random(5)."_".$name;
            if(file_exists("upload/slide/".$hinh)){
                $hinh = Str_random(5)."_".$name;
            }
            $file->move("upload/slide",$hinh);
            unlink("upload/slide/".$slide->Hinh);
            $slide->Hinh = $hinh;
        }
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('success',"Sua Thanh cong");
    }
    public function getXoa($id){
        $slide = Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/danhsach')->with('success','Xoa thanh cong');
    }
}
