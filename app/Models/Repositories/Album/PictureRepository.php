<?php

namespace App\Models\Repositories\Album;

use App\Models\Album;
use App\Models\Picture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\ImageVideoUpload;

class PictureRepository
{

    private ImageVideoUpload $ImageUpload;
    public function __construct(ImageVideoUpload $ImageUpload)
    {
        $this->ImageUpload = $ImageUpload;
    }
    public function index($album_id)
    {
        $data = Picture::where('album_id',$album_id)->orderBy('id', 'DESC')->get();
        return $data;
    }
    public function show($id)
    {
        $pic = Picture::findOrfail($id);
        return $pic;
    }
    public function store($request)
    {
        $data = $request->except(['_token','image']);

        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $data['image'] = $this->ImageUpload->StoreImageSingle($request->image, 'Picture');
            }
              Picture::create($data);

            DB::commit();
        } catch (\Exception $e) {
        //    dd($e);
            DB::rollback();
            return 'error';
        }

    }

    public function update($request, $id)
    {

        $pic = $this->show($id);

        $data = $request->except(['_token','image']);

        DB::beginTransaction();
        try {
            if($request->hasFile('image')){
                $image = $this->ImageUpload->UpdateImageSingle($request->file('image'),'Picture',$pic->image);
                $data['image'] = $image;
            }
            $pic->update($data);

            DB::commit();
            return $pic->album_id;
        } catch (\Exception $e) {
          dd($e);
            DB::rollback();
            return 'error';
        }
    }
    public function destroy($id)
    {
        $pic = $this->show($id);
        DB::beginTransaction();
        try {
            $this->ImageUpload->DeleteImageSingle($pic->image);
            $pic->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            //  dd($e);
            return 'error';
        }
    }
}
