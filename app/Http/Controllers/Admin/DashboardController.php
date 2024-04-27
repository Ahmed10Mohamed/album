<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Admin;
use App\Models\Repositories\DashboardRepository;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected DashboardRepository $dashboardRepository;
    function __construct(DashboardRepository $dashboardRepository){
        $this->dashboardRepository = $dashboardRepository;
    }
    public function index(Request $request)
    {
            $class        = "dashboard";
            $data         = $this->dashboardRepository->index();
            $albums       = $data['albums'];
            $picts        = $data['picts'];
            $count_albums = $data['count_albums'];
            $count_picts  = $data['count_picts'];
        return view('admin.home',compact('class','albums','picts','count_albums','count_picts'));
    }
    public function custom_logout(){
        $gurad = Auth::guard('web');
        $gurad->logout();
        return redirect('login')->with('success',translate('logout success'));

    }

    public function change_password()
    {
        $class = 'profile';
        return view('admin.pages.admins.change_password',compact('class'));
    }



}
