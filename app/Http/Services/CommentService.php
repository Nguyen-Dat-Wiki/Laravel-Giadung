<?php

namespace App\Http\Services;

use DB;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Comment;


class CommentService{
    public function get($request)
    {
        $query = Comment::with(['product' => function ($query) {
            $query->select( 'id', 'name','thumb');
        }]);
        
        if ($request->input('id')) {
            $query->orderBy('id', $request->input('id'));
        }
        else if ($request->input('name')) {
            $query->orderBy('name', $request->input('name'));
        }
        else if ($request->input('content')) {
            $query->orderBy('content', $request->input('content'));
        }
        else if($request->input('created_at')){
            $query->orderBy('created_at',$request->input('created_at'));
        } 
        
        return $query->paginate(10)
        ->withQueryString()
        ->appends(request()->query());
    }
}