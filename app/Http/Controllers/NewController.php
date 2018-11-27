<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $slug= str_slug($data['title']);
            $file = $request->file('img');
            if(!empty($file)){
            $messages = [
                    'image' => 'Định dạng không cho phép',
                    'max' => 'Kích thước file quá lớn',
                ];
                // Điều kiện cho phép upload
                $this->validate($request, [
                    'file' => 'image|max:2028',
                ], $messages);

                if ($request->file('img')->isValid()){
                    // Lấy tên file
                    $file_name = $request->file('img')->getClientOriginalName();
                    // Lưu file vào thư mục upload với tên là biến $filename
                    $urlFile = $request->file('img')->move('uploads',$file_name);
                }
            }else {
                $urlFile = null;
            }
        $result = News::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $urlFile,
            'tag' => $data['tag'],
            'slug' => $slug
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    public function showDetail($slug,$id) {
       $result = News::where('id',$id)
                        ->first();
        return view('new.show',compact('result'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
