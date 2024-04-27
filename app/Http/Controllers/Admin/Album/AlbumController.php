<?php

namespace App\Http\Controllers\Admin\Album;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlbumRequest;
use App\Http\Requests\moveAlbumRequest;
use App\Models\Repositories\Album\AlbumRepository;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected AlbumRepository $albumRepository;
    function __construct(AlbumRepository $albumRepository){
        $this->albumRepository = $albumRepository;
    }
    public function index()
    {
        $all_data = $this->albumRepository->index();

        $class = 'album';
        return view('admin.pages.album.index',compact('all_data','class'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlbumRequest $request)
    {
        $data = $this->albumRepository->store($request);
        if($data =='error'){
            return errorResponseMessage('Opps! Try Again Letter');
        }else{
            return response()->json([
                'success' => true,
                'message' => 'Addedd Success'
            ]);
        }
    }
    public function album_move(moveAlbumRequest $request){
        $data = $this->albumRepository->album_move($request);
        if($data =='error'){
            return errorResponseMessage('Opps! Try Again Letter');
        }else{
            return response()->json([
                'success' => true,
                'message' => 'Moved Success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->albumRepository->show($id);
        $all_data = $data->pictures;
        $class = 'album';
        return view('admin.pages.album.pictures.index',compact('data','all_data','class'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->albumRepository->update($request,$id);
        if($data =='error'){
            return errorResponseMessage('Opps! Try Again Letter');
        }else{
            return successResponseMessage('Updated Success');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->albumRepository->destroy($id);
        if($data =='error'){
            return redirect()->back()->with('fail','Opps! Try Again Letter');
        }else{
            return redirect()->back()->with('success','destroy Success');
        }

    }
}
