<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use App\Models\TinTuc;

class CommentController extends Controller
{
    //
    public function getXoa($id,$idTinTuc){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('xoathanhcong','Da xoa comment');
    }
    public function postComment(Request $req, $id){
        $idTinTuc = $id;
        $cm = new Comment();
        $tintuc = TinTuc::find($id);
        $cm->idTinTuc = $id;
        $cm->idUser = Auth::user()->id;
        $cm->NoiDung = $req->noidung;
        $cm->save();
        return redirect("chitiet/$id/".$tintuc->TieuDeKhongDau.".html")->with("thongbao", "Viết Bình Luận Thành Công"); 
    }
}
