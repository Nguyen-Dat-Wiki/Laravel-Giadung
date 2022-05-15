<?php


namespace App\Http\Services;


use App\Models\Blog;
use Illuminate\Support\Facades\Session;
use DB;
class NewsService{

    public function getsearch($request)
    {
        return Blog::where('active',1)
        ->where('title','LIKE', "%{$request->input('search')}%")
        ->orderby('created_at','desc')
        ->paginate(9)
        ->appends(request()->query());
    }
    
    public function get()
    {
        return Blog::where('active',1)
        ->orderby('created_at','desc')
        ->paginate(9)
        ->appends(request()->query());
    }

    public function getTime()
    {
        return Blog::where('active',1)
        ->orderby('created_at','desc')
        ->paginate(7)
        ->appends(request()->query());
    }

    public function insert($request)
    {
        try {
            $request->except('_token');
            Blog::create($request->all());

            Session::flash('success', 'Thêm tin tức thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm tin tức lỗi');
            \Log::info($err->getMessage());
            return  false;
        }
        return  true;
    }

    public function update($request, $blog)
    {
        try {
            $blog->fill($request->input());
            $blog->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $blog = Blog::where('id', $request->input('id'))->first();
        if ($blog) {
            $blog->delete();
            return true;
        }

        return false;
    }

    public function search($request)
    {   
        $search= $request->input('search');
        return Blog::where('title', 'like', '%' . $search . '%')
            ->orderByDesc('id')->paginate(15); 
    }

    public function getList($request)
    {
        $query =  DB::table('blogs');

        if ($request->input('id')) {
            $query->orderBy('id', $request->input('id'));
        }
        else if ($request->input('name')) {
            $query->orderBy('name', $request->input('name'));
        }
        else if($request->input('title')){
            $query->orderBy('title',$request->input('title'));
        } 
        else if($request->input('created_at')){
            $query->orderBy('created_at',$request->input('created_at'));
        } 
        return $query
            ->paginate(15)
            ->withQueryString()
            ->appends(request()->query());
    }
    public function show($id)
    {
        return Blog::where('id', $id)
            ->where('active', 1)
            ->firstOrFail();
    }

}
