<?php

namespace App\Models\Repositories\Album;

use App\Models\Album;
use App\Models\Picture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AlbumRepository
{


    public function index()
    {
        $data = Album::orderBy('id', 'DESC')->get();
        return $data;
    }
    public function show($id)
    {
        $album = Album::findOrfail($id);
        return $album;
    }
    public function store($request)
    {
        $data = $request->except(['_token']);

        DB::beginTransaction();
        try {

              Album::create($data);

            DB::commit();
        } catch (\Exception $e) {
        //    dd($e);
            DB::rollback();
            return 'error';
        }
    }
    public function album_move($request){
        $album = $this->show($request->id);
      

        DB::beginTransaction();
        try {
            foreach ($album->pictures as $picture) {
                $picture->update(['album_id' => $request->album_id]); // Update each picture with new album_id
            }
            
              $album->delete();

            DB::commit();
        } catch (\Exception $e) {
          dd($e);
            DB::rollback();
            return 'error';
        }
    }
    public function update($request, $id)
    {

        $album = $this->show($id);

        $data = $request->except(['_token']);

        DB::beginTransaction();
        try {

            $album->update($data);

            DB::commit();
        } catch (\Exception $e) {
          dd($e);
            DB::rollback();
            return 'error';
        }
    }
    public function destroy($id)
    {
        $album = $this->show($id);
        DB::beginTransaction();
        try {
            
            $album->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            //  dd($e);
            return 'error';
        }
    }
}
