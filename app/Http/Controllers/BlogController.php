<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Services\NewsService;


class BlogController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function create()
    {
        return view('admin.blogs.add',[
            'title' => 'Thêm tin tức',
        ]);
    }
    public function store(Request $request)
    {
        $this->newsService->insert($request);
        return redirect()->back();
    }

    public function index(Request $request)
    {
        return view('admin.blogs.list', [
            'title' => 'Danh Sách Tin Tức',
            'news' => $this->newsService->getList($request)
        ]);
    }

    public function show(Blog $blog)
    {
        return view('admin.blogs.edit', [
            'title' => 'Chỉnh Sửa Tin Tức',
            'news' => $blog,
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        $result = $this->newsService->update($request, $blog);
        if ($result) {
            return redirect('/admin/blogs/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->newsService->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công tin tức'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }

    public function search(Request $request)
    {   
        
        return view('admin.blogs.search', [
            'title' => 'Tìm kiếm tin tức',
            'news' => $this->newsService->search($request)
        ]);
    }
}
