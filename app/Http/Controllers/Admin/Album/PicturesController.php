<?php

namespace App\Http\Controllers\Admin\Album;

use App\Http\Controllers\Controller;
use App\Models\Repositories\Album\PictureRepository;
use Illuminate\Http\Request;

class PicturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected PictureRepository $pictureRepository;
    function __construct(PictureRepository $pictureRepository){
        $this->pictureRepository = $pictureRepository;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function add($album_id){
        $class = 'album';
        return view('admin.pages.album.pictures.create',compact('class','album_id'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->pictureRepository->store($request);
        if($data =='error'){
            return redirect()->back()->with('fail','Opps! Try Again Letter');
        }else{
            return redirect()->route('Album.show',['Album' => $request->album_id])->with('success','destroy Success');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->pictureRepository->show($id);
        $class = 'album';
        return view('admin.pages.album.pictures.edit',compact('class','data'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->pictureRepository->update($request,$id);
        if($data =='error'){
            return redirect()->back()->with('fail','Opps! Try Again Letter');
        }else{
            return redirect()->route('Album.show',['Album' => $data])->with('success','destroy Success');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->pictureRepository->destroy($id);
        if($data =='error'){
            return redirect()->back()->with('fail','Opps! Try Again Letter');
        }else{
            return redirect()->back()->with('success','destroy Success');
        }
    }
}
