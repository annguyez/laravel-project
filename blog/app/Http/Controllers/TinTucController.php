<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\Comment;
use Illuminate\Support\Str;

class TinTucController extends Controller
{
    //
    public function getDanhSach(){
        $tintuc = TinTuc::all();
        return view('admin/tintuc/danhsach', ['tintuc' => $tintuc]);
    }
    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();

        return view('admin/tintuc/them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThem(Request $req){
        $this->validate($req,
        [
            'loaitin'=>'required',
            'tieude'=>'required',
            'tomtat'=>'required',
            'noidung'=>'required',
        ],
        [
            'loaitin.required'=>'Ban chua chon loaitin',
            'tieude.required'=>'Ban chua chon tieude',
            'tomtat.required'=>'Ban chua chon tomtat',
            'noidung.required'=>'Ban chua chon noidung',
        ]);
        $tintuc = new TinTuc();
        $tintuc->TieuDe = $req->tieude;
        $tintuc->TieuDeKhongDau = changeTitle($req->tieude);
        $tintuc->idLoaiTin = $req->loaitin;
        $tintuc->TomTat = $req->tomtat;
        $tintuc->NoiDung = $req->noidung;
        if($req->hasFile('hinh')){
            $file = $req->file('hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi !='jpeg'){
                return redirect('admin/tintuc/them')->with('loi','Moi ban chon dinh dang file khac');
            }
            $name = $file->getClientOriginalName();
            $hinh = Str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$hinh));
            {
                $hinh = Str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$hinh);
            $tintuc->Hinh = $hinh;
        }else{
            $tintuc->Hinh ="";
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with("thanhcong","Da them thanh cong");
    }
    public function getSua($id){

        $tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin/tintuc/sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postSua(Request $req, $id){
        $tintuc = TinTuc::find($id);
        $this->validate($req,
        [
            'loaitin'=>'required',
            'tieude'=>'required',
            'tomtat'=>'required',
            'noidung'=>'required',
        ],
        [
            'loaitin.required'=>'Ban chua chon loaitin',
            'tieude.required'=>'Ban chua chon tieude',
            'tomtat.required'=>'Ban chua chon tomtat',
            'noidung.required'=>'Ban chua chon noidung',
        ]);

        $tintuc->idLoaiTin = $req->loaitin;
        $tintuc->TieuDe = $req->tieude;
        $tintuc->TieuDeKhongDau = changeTitle($req->tieude);
        $tintuc->NoiDung = $req->noidung;
        $tintuc->TomTat = $req->tomtat;
        $tintuc->NoiBat = $req->noibat;
        if($req->hasFile('hinh')){
            $file = $req->file('hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpeg' && $duoi != 'jpg' && $duoi != 'png'){
                 return redirect('admin/tintuc/sua/'.$id)->with('loi',"Moi ban chon file dinh dang khac"); 
            }
            $name = $file->getClientOriginalName();
            $hinh = Str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$hinh)){
                $hinh = Str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $hinh;
        }
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with("suathanhcong","da sua thanh cong");
    }
    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete($id);
        return redirect('admin/tintuc/danhsach')->with('xoathanhcong',"Xoa thanh cong");
    }
}
