<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

use App\Models\Admin;
use App\Models\AdminPermission;
use App\Models\Log;
use App\Models\User;

class AdminController extends Controller
{
    public function not_authorized(){
        return view('admin.pages.admins.not_authorized');

    }
    public function users(){
        if(!permission_group_checker(auth()->user()->id, 'Users')) {return  redirect('not_authorized');}
         $users = User::orderBy('id', 'DESC')->get();
        $class = 'users';
        return view('admin.pages.admins.users')->with(['users'=>$users,'class'=>$class]);

    }
    public function index()
    {
         if(!permission_group_checker(auth()->user()->id, 'User')) {return  redirect('not_authorized');}

        $admins = User::get();
        $class = 'admins';
        return view('admin.pages.admins.index')->with(['admins'=>$admins,'class'=>$class]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function change_block($id){
        $user = User::findOrfail($id);
        $user->block = !$user->block;
        $user->save();
        if($user->block == 1){
            $msg = 'Block This Account '.$user->name;
        }else{
            $msg = 'Remove Block From This Account '.$user->name;

        }
        $log = new Log();
        $log->type =$msg;
        $log->action = 'update';
        $log->user = user()->id;
        $log->save();
        return redirect()->back()->with('success','Change User SuccessFully');
    }

    public function create()
    {
         if(!permission_checker(auth()->user()->id, 'add_user'))  {return  redirect('not_authorized');}
        $class = 'admins';

         return view('admin.pages.admins.create',compact('class'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if(!permission_checker(auth()->user()->id, 'add_user'))  {return  redirect('not_authorized');}
        $validatedData = $request->validate([
            'name' => 'required',
            'user_name' => 'required|unique:admins,user_name,NULL,id,deleted_at,NULL',
            'email' => 'nullable|email|unique:admins,email,NULL,id,deleted_at,NULL' ,
            'password' => 'required|confirmed',
        ],
        [
            'name.required'=>'من فضلك ادخل الاسم',
            'user_name.required'=>'من فضلك ادخل اسم المستخدم',
            'user_name.unique'=>'اسم المستخدم مسجل في حساب اخر',
            'email.unique'=>'البريد الالكتروني مسجل في حساب اخر',
            'email.email'=>'من فضلك ادخل بريد الكتروني صحيح ',
            'password.required'=>'من فضلك ادخل كلمة المرور',
            'password.confirmed'=>'قم بتأكيد كلمة المرور',
        ]);
        $admin = new User();
        $admin->name  = $request->name;
        $admin->user_name  = $request->user_name;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->added_by = auth()->user()->id;
        $admin->password = bcrypt($request->password);
        /*
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/admins');
            $image->move($destinationPath, $imageName);
            $admin->image ='/uploads/admins/'.$imageName;
        }
        */
        $admin->save();
        if($request->permission)
        {
            for($i = 0; $i < count($request->permission); $i++)
            {
                $adp = new AdminPermission;
                $adp->admin = $admin->id;
                $adp->permission = $request->permission[$i];
                $adp->save();
            }
        }
        $log = new Log();
        $log->type = 'Create User';
        $log->action = 'create';
        $log->user = user()->id;
        $log->save();
        return redirect()->route('admins.index');
    }

    public function edit($id)
    {
         if(!permission_checker(auth()->user()->id, 'edit_user'))  {return  redirect('not_authorized');}
        $admin = User::findorfail($id);
                $class = 'admins';

        return view('admin.pages.admins.edit')->with(['admin'=>$admin,'class'=>$class]);
    }

    public function profile()
    {
        $admin = User::findorfail(auth()->user()->id);
                $class = 'admins';

        return view('admin.pages.admins.profile')->with(['admin'=>$admin,'class'=>$class]);
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
         if(!permission_checker(auth()->user()->id, 'edit_user'))  {return  redirect('not_authorized');}
        $admin = User::findorfail($id);
        $validatedData = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required'=>'من فضلك ادخل الاسم',
        ]);

        if($admin->user_name != $request->user_name)
        {
            $validatedData = $request->validate([
                'user_name' => 'required|unique:admins,user_name,'.$id.',id,deleted_at,NULL',
            ],
            [
                'user_name.required'=>'من فضلك ادخل اسم المستخدم',
                'user_name.unique'=>'اسم المستخدم مسجل في حساب اخر',
            ]);
        }
        if($admin->email != $request->email && $request->email != '')
        {
            $validatedData = $request->validate([
                'email' => 'required|email|unique:admins,email,'.$id.',id,deleted_at,NULL',
            ],
            [
                'email.required'=>'من فضلك ادخل بريد الكتروني صحيح',
                'email.unique'=>'البريد الالكتروني مسجل في حساب اخر',
                'email.email'=>'من فضلك ادخل بريد الكتروني صحيح ',
            ]);
        }


        $admin->name  = $request->name;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->user_name = $request->user_name;
          //  update password
            if($request->password){
                $validatedData = $request->validate([
                    'password' => 'required|confirmed',
                ],
                [
                    'password.required'=>'من فضلك ادخل كلمة المرور',
                    'password.confirmed'=>'قم بتأكيد كلمة المرور',
                ]);
                $admin->password = bcrypt($request->password);
            }

        // $admin->updated_by = auth()->user()->id;
       $old_per = AdminPermission::where('admin',$admin->id)->get();
        foreach($old_per as $aa)
        {
            $aa->delete();
        }
         if($request->permission)
        {
            for($i = 0; $i < count($request->permission); $i++)
            {
                $adp = new AdminPermission;
                $adp->admin = $admin->id;
                $adp->permission = $request->permission[$i];
                $adp->save();
            }

        }
        $admin->save();
        $log = new Log();
        $log->type = 'UpUpdate User Date';
        $log->action = 'update';
        $log->user = user()->id;
        $log->save();
        return redirect()->route('admins.index');
    }

    public function save_profile(Request $request)
    {
        $admin = User::findorfail(auth()->user()->id);
        $validatedData = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required'=>'من فضلك ادخل الاسم',
        ]);

        if($admin->user_name != $request->user_name)
        {
            $validatedData = $request->validate([
                'user_name' => 'required|unique:admins,user_name,'.$admin->id.',id,deleted_at,NULL',
            ],
            [
                'user_name.required'=>'من فضلك ادخل اسم المستخدم',
                'user_name.unique'=>'اسم المستخدم مسجل في حساب اخر',
            ]);
        }
        if($admin->email != $request->email && $request->email != '')
        {
            $validatedData = $request->validate([
                'email' => 'required|email|unique:admins,email,'.$admin->id.',id,deleted_at,NULL',
            ],
            [
                'email.required'=>'من فضلك ادخل بريد الكتروني صحيح',
                'email.unique'=>'البريد الالكتروني مسجل في حساب اخر',
                'email.email'=>'من فضلك ادخل بريد الكتروني صحيح ',
            ]);
        }


        $admin->name  = $request->name;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->user_name = $request->user_name;
        // $admin->updated_by = auth()->user()->id;


        $admin->save();
        return redirect('/admin');
    }


    public function change_password($id)
    {
         if(!permission_checker(auth()->user()->id, 'change_user_password'))  {return  redirect('not_authorized');}
        $admin = User::findorfail($id);
                $class = 'admins';

        return view('admin.pages.admins.edit_password')->with(['admin'=>$admin,'class'=>$class]);
    }

    public function change_profile_password ()
    {
        $admin = User::findorfail(auth()->user()->id);
        return view('admin.pages.admins.change_mpassword')->with(['admin'=>$admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function password_save(Request $request, $id)
    {
         if(!permission_checker(auth()->user()->id, 'change_user_password'))  {return  redirect('not_authorized');}
        $admin = User::findorfail($id);
        $validatedData = $request->validate([
            'password' => 'required|confirmed',
        ],
        [
            'password.required'=>'من فضلك ادخل كلمة المرور',
            'password.confirmed'=>'قم بتأكيد كلمة المرور',
        ]);
        $admin->password = bcrypt($request->password);
        // $admin->updated_by = auth()->user()->id;
        $admin->save();
        $log = new Log();
        $log->type = 'Update Pasword of User';
        $log->action = 'update';
        $log->user = user()->id;
        $log->save();
        return redirect()->route('admins.index');
    }
    public function save_profile_password(Request $request)
    {
        $admin = User::findorfail(auth()->user()->id);
        $validatedData = $request->validate([
            'password' => 'required|confirmed',
        ],
        [
            'password.required'=>'من فضلك ادخل كلمة المرور',
            'password.confirmed'=>'قم بتأكيد كلمة المرور',
        ]);
        $admin->password = bcrypt($request->password);
        // $admin->updated_by = auth()->user()->id;
        $admin->save();
        $admin->save();
        $log = new Log();
        $log->type = 'Update Pasword of User';
        $log->action = 'update';
        $log->user = user()->id;
        $log->save();
        return redirect('/admin');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
         if(!permission_checker(auth()->user()->id, 'delete_user'))  {return  redirect('not_authorized');}
        $admin = User::findorfail($id);
       $admin->deleted_by = auth()->user()->id;
        $admin->save();
        $admin->delete();
        $admin->save();
        $log = new Log();
        $log->type = 'Delete User Account';
        $log->action = 'update';
        $log->user = user()->id;
        $log->save();
        return redirect()->route('admins.index');
    }
}
