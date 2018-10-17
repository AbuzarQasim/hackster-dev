<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users  = User::all();
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //this is for fetching the roles and then populating the role select form field..
        // we didnt use all because all will bring collection and we want an array
        $roles = Role::lists('name','id')->all();

        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest$request)
    {
        //to store the user data all we have to do is use the User model

       // return $request->all();

        $input = $request->all();
        if($file = $request->file('photo_id'))
        {

            $name  = time(). $file->getClientOriginalName();

            $file->move('images',$name);

            $photo = Photo::create(['path'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $input['password']=bcrypt($request->password);
        User::create($input);
//
//
        Session::flash('created_user','The user has been created');
        return redirect('admin/users');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('admin.user.show');
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

        $user = User::findOrFail($id);
        $roles = Role::lists('name','id')->all();
        return view('admin.user.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);

        // use the below code if you have allowed the user to skip the password field for updation  by creating a new edit request
        //this will assign all the fields except password if it is not set in the edit page
        // REMOVE THE bcrypt password statment from end ...if using this method
//        if(trim($request->password) =='')
//        {
//            $input=$request->except('password');
//        }else
//        {
//            $input = $request->all();
      //  $input['password']=bcrypt($request->password);
//        }

        $input = $request->all();

        if($file = $request->file('photo_id'))
        {



            $name= time().$file->getClientOriginalName();
            $file->move('images',$name);

            if($user->photo_id =="" || $user->photo_id ==null )
            {
                $photo = Photo::create(['path'=>$name]);

                $input['photo_id'] = $photo->id;
            }
            else{

                $photo = Photo::find($user->photo_id);
                $photo->path= $name;
                $photo->save();

                $input['photo_id'] = $photo->id;
            }

        }
        $input['password']=bcrypt($request->password);

           $user->update($input);

        Session::flash('updated_user','The user has been updated');
        return redirect('admin/users');

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


      //  User::findOrFail($id)->delete();
    $user = User::findOrFail($id);

        unlink(public_path(). $user->photo->path);

        $user->delete();
        Session::flash('deleted_user','The user has been deleted');


      return  redirect('admin/users');
    }
}
