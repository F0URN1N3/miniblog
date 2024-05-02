<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsfeed;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class NewsfeedController extends Controller
{
    public function index()
    {
        $newsfeeds = Newsfeed::latest()->get();
        return view('newsfeed.index', compact('newsfeeds'));
    }

    public function getComments($id)
    {
        //DB::enableQueryLog();
        // $newsfeed = Newsfeed::findOrFail($id);
        // $comments= Comment::where('nf_id', $id)->get();
        // return response()->json(['comments' => $comments]);
        $newsfeed = Newsfeed::findOrFail($id);
        $comments= Comment::query()
            ->select('comments.*', 'users.name')
            ->join('users', 'users.id', '=', 'comments.u_id')
            ->where('comments.nf_id','=', $id)
            ->get();
        //print_r(DB::getQueryLog());
        return response()->json(['comments' => $comments]);
    }

    public function storeComment(Request $request, $id)
    {
        $newsfeed = Newsfeed::findOrFail($id);
        $User= $this->GetUserData();
        // 儲存新的 comment
        $comment = new Comment();
        $comment->u_id = $User->id;
        $comment->nf_id = $newsfeed->id;
        $comment->content = $request->content;
        $comment->save();

        return response()->json(['success' => true]);
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $User= $this->GetUserData();
        if($User->id== $comment->u_id){
            Comment::where('id', $id)->delete();
        }
        return response()->json(['success' => true]);
    }
}
