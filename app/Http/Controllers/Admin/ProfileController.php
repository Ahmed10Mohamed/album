<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Repositories\ProfileRepository;
class ProfileController extends Controller
{
    private ProfileRepository $profileRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ProfileRepository $profileRepository){
        $this->profileRepository = $profileRepository;
    }
    public function index(){
          $class = 'profile';

        return view('admin.pages.profile.account_setting',compact('class'));
    }
    public function update_profile(ProfileRequest $request){


        $data = $this->profileRepository->update_profile($request);
        if($data === 'error'){
            return redirect()->back()->with('fail',translate('Something is wrong! Try later'));
        }else{
            return redirect()->back()->with('success',translate('Data Updated Success'));

        }
    }
     public function security()
    {
            $class = 'change_pssword';

            return view('admin.pages.profile.change_password',compact('class'));
    }
      public function update_password(PasswordRequest $request){

        $data = $this->profileRepository->update_password($request);
        if($data === 'error'){
            return redirect()->back()->with('fail',translate('Something is wrong! Try later'));
        }else{
            return redirect()->back()->with('success',translate('Password Changed Success'));

        }

    }


}
