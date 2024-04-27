<?php

namespace App\Models\Repositories;
use App\Interfaces\ImageVideoUpload;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Mail\SignatureEmailVisitor;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Session;

class ProfileRepository
{
    private ImageVideoUpload $ImageUpload;
    public function __construct(ImageVideoUpload $ImageUpload)
    {
        $this->ImageUpload = $ImageUpload;
    }


    public function update_profile($request)
    {
        $data = $request->except(['_token','image']);

        $request_image = $request->file('image');
       $model = 'User';
       $admin = User::find(user()->id);
       DB::beginTransaction();
       try {
             if($request->hasFile('image')){
                 $data['image'] = $this->ImageUpload->StoreImageSingle($request_image,$model);
              }
              $admin->update($data);

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();
            //  dd($e);
           return 'error';
        }


    }
    public function update_password($request)
    {
        $data = $request->except(['_token','password']);
       DB::beginTransaction();
       try {
           $admin = User::find(user()->id);

            if(!Hash::check($request->current_password, $admin->password))
            {
                return redirect()->back()->withInput()->withErrors(['current_password'=>translate('Current Password Not Correct')]);
            }
            else
            {
                $data['password'] = bcrypt($request->password);
            }

            $admin->update($data);
           
            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();
            //  dd($e);
           return 'error';
        }


    }














}
