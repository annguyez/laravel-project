<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    //
    public function getDanhSach(){
        $user = User::all();
        return view('admin/user/danhsach',['user'=>$user]);
    }
    public function getThem(){
        return view('admin/user/them');
    }
    public function postThem(Request $req){
        $user = new User();
        $this->validate($req,
        [
            'name'=>'required|min:3|max:25',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|max:22',
            'passwordComfirm'=>'required|same:password'
        ],
        [
            'name.required'=>'Ten khong duoc de trong',
            'name.min'=>'Ten khong duoc it hon 3 ky tu',
            'name.max'=>'Ten khong duoc nhieu hon 25 ky tu',
            'email.required'=>'Email khong duoc de trong',
            'email.unique'=>'Email da ton tai',
            'password.required'=>'PAssword khong duoc de trong',
            'passwordComfirm.required'=>'passwordComfirm khong duoc de trong',
            'password.min'=>'password khong duoc it hon 3 ky tu',
            'password.max'=>'password khong duoc nhieu hon 25 ky tu',
            'passwordComfirm.same'=>'password nhap lai khong khop',
        ]);
        $user->name = $req->name;
        $user->email= $req->email;
        $user->quyen = $req->quyen;
        $user->password = bcrypt($req->password);

        $user->save();
        return redirect('admin/user/them')->with('success','Them thanh cong');

    }
    public function getXoa($id){
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('success','Xoa thanh cong');
    }
    public function getSua($id){
        $user = User::find($id);
        return view('admin/user/sua',['user'=>$user]);
    }
    public function postSua(Request $req, $id){
        $this->validate($req,
        [
            'name'=>'required|min:3|max:25',
        ],
        [
            'name.required'=>'Ten khong duoc de trong',
            'name.min'=>'Ten khong duoc it hon 3 ky tu',
            'name.max'=>'Ten khong duoc nhieu hon 25 ky tu',
            
        ]);
        $user = User::find($id);
        $user->name = $req->name;
        $user->password = bcrypt($req->password);
        $user->quyen = $req->quyen;
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('success','Sua thanh cong');
    }
    public function getDangnhapAdmin(){
        return view('admin/login');
    }
    public function postDangnhapAdmin(Request $req){
        $this->validate($req,
        ['email'=>'required',
            'password'=>'required'
    ],
        ['email.required'=>'Email khong duoc de trong',
        'password.required'=>'Password khong duoc de trong'
        ]);
        if(Auth::attempt(['email'=>$req->email,
                        'password'=>$req->password]))
        {
            return redirect('admin/theloai/danhsach')->with('success','Dang nhap thanh cong');
        }else{
            return redirect('admin/dangnhap')->with('fails','Dang nhap that bai');
        }
    }
    public function getLogout(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
