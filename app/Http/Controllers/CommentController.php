<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Services\CommentService;

class CommentController extends Controller
{
    protected $comment;
    public function __construct(CommentService $comment)
    {
        $this->comment = $comment;
    }

    public function show(Request $request)
    {
        return view('admin.comment.list', [
            'title' => 'Danh sách sản phẩm có comment',
            'comments' => $this->comment->get($request)
        ]);
    }
}
?>