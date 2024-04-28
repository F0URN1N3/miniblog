<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Newsfeed;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{

    public function listComment($nf_id)
    {
            $newsfeed= Newsfeed::findOrFail($nf_id);
            $comments= comment::where('nf_id', $nf_id)->get();
            return response()->json(['comments' => $comments]);
    }

    public function insertComment(Request $request,$nf_id)
    {
        Newsfeed::findOrFail($nf_id);
        //先取得自己的資料
        $User = $this->GetUserData();

        $request->validate([
            'comment' => 'required|min:1'
        ]);

        $inputComment= $request->input('comment');

        $inesertData['u_id']= $User->id;
        $inesertData['nf_id']= $nf_id;
        $inesertData['content']= $inputComment;
        $inesertData['enable']= 1;

        comment::create($inesertData);
        return response()->json(['success' => true]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comment $comment)
    {
        //
    }
}
