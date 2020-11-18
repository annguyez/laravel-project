<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\Slide;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class PagesController extends Controller
{
    //
    function __construct(){
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share('theloai',$theloai);
        view()->share('slide',$slide);
        
    }
    function trangchu(){
        return view('pages.trangchu');
    }
    function loaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin', $id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    function chitiet($id){
        $tintuc = TinTuc::find($id);
        $tinnoibat = Tintuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = Tintuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.chitiet',['tintuc'=>$tintuc,
        'tinnoibat'=>$tinnoibat,
        'tinlienquan'=>$tinlienquan
        ]);

    }
    function getDangnhap(){
        return view('pages.dangnhap');
    }
    function postDangnhap(Request $req){
        $this->validate($req,
        ['email'=>'required',
            'password'=>'required'
        ],
        ['email.required'=>'Email khong duoc de trong',
        'password.required'=>'Password khong duoc de trong'
        ]);
        if(Auth::attempt(['email'=>$req->email,
        'password'=>$req->password
        ]))
        {   return redirect('trangchu');
        }else{
            return redirect('dangnhap')->with('fails','Dang nhap that bai');
        }
    }
    function getDangxuat(){
        Auth::logout();
        return redirect('dangnhap');
    }
    function getNguoidung(){
        return view('pages.nguoidung');
    }
    function postNguoidung(Request $req){
        $this->validate($req,
        [
            'name'=>'required|min:3|max:25',
        ],
        [
            'name.required'=>'Ten khong duoc de trong',
            'name.min'=>'Ten khong duoc it hon 3 ky tu',
            'name.max'=>'Ten khong duoc nhieu hon 25 ky tu',
            
        ]);
        $user = Auth::user();
        $user->name = $req->name;
        $user->password = bcrypt($req->password);
        $user->save();
        return redirect('nguoidung')->with('success','Bạn đã sửa thành công');
    }
    function getDangky(){
        return view('pages.dangky');

    }
    function postDangky(Request $req){
        $user = new User();
        $this->validate($req,
        [
            'name'=>'required|min:3|max:25',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|max:22',
            'passwordAgain'=>'required|same:password'
        ],
        [
            'name.required'=>'Ten khong duoc de trong',
            'name.min'=>'Ten khong duoc it hon 3 ky tu',
            'name.max'=>'Ten khong duoc nhieu hon 25 ky tu',
            'email.required'=>'Email khong duoc de trong',
            'email.unique'=>'Email da ton tai',
            'password.required'=>'PAssword khong duoc de trong',
            'passwordAgain.required'=>'passwordAgain khong duoc de trong',
            'password.min'=>'password khong duoc it hon 3 ky tu',
            'password.max'=>'password khong duoc nhieu hon 25 ky tu',
            'passwordAgain.same'=>'password nhap lai khong khop',
        ]);
        $user->name = $req->name;
        $user->email= $req->email;
        $user->quyen = 0;
        $user->password = bcrypt($req->password);

        $user->save();
        return redirect('dangky')->with('success','Chúc mừng bạn đã đăng ký thành công');
    }
    function timkiem(Request $req){
        $tukhoa = $req->tukhoa;
        $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")->paginate(5)->appends(['tukhoa' => $tukhoa]);
        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }

}
