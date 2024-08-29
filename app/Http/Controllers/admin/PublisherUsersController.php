<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\users\CreateUser;
use App\User;
use Response;

class PublisherUsersController extends Controller
{
    //
    public function index()
    {
        $users = User::where('role','2')->orderBy('id','desc')->paginate(25);
        return view('AdminPanel.publishers.index',[
            'active' => 'publisherUsers',
            'title' => trans('common.Publishers'),
            'users' => $users,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.Publishers')
                ]
            ]
        ]);
    }

    public function blockAction($id,$action)
    {
        $update = User::find(auth()->user()->id)->update(['block'=>$action]);
        if ($update) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }
    }
    
    public function create()
    {
        return view('AdminPanel.publishers.create',[
            'active' => 'publisherUsers',
            'title' => trans('common.Publishers'),
            'breadcrumbs' => [
                                [
                                    'url' => route('admin.publisherUsers'),
                                    'text' => trans('common.Publishers')
                                ],
                                [
                                    'url' => '',
                                    'text' => trans('common.CreateNew')
                                ]
                            ]
        ]);
    }

    public function store(CreateUser $request)
    {
        $data = $request->except(['_token','photo','password','hidden']);
        if ($request->photo != '') {
            $data['photo'] = upload_image_without_resize('users/'.auth()->user()->id , $request->photo );
        }
        $data['password'] = bcrypt($request['password']);
        $data['role'] = '2';

        $user = User::create($data);
        if ($user) {
            return redirect()->route('admin.publisherUsers')
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }
        
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('AdminPanel.publishers.edit',[
            'active' => 'publisherUsers',
            'title' => trans('common.Publishers'),
            'user' => $user,
            'breadcrumbs' => [
                                [
                                    'url' => route('admin.publisherUsers'),
                                    'text' => trans('common.Publishers')
                                ],
                                [
                                    'url' => '',
                                    'text' => trans('common.Edit').': '.$user->name
                                ]
                            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->except(['_token','photo','password','hidden']);
        // return $data;
        if ($request->photo != '') {
            if ($user->photo != '') {
                delete_image('users/'.$id , $user->photo);
            }
            $data['photo'] = upload_image_without_resize('users/'.$id , $request->photo );
        }
        if ($request['password'] != '') {
            $data['password'] = bcrypt($request['password']);
        }
        if ($user['active'] == '0' && $request['active'] == '1') {
            $notificationText = notificationTextTranslate([
                                            'name' => auth()->user()->name,
                                            'type' => 'activatePublisherAccount'
                                        ],
                                        $user['language']);
            $notificationData = [
                'type' => 'activatePublisherAccount',
                'linked_id' => $user->id,
                'text' => $notificationText,
                'date' => date('Y-m-d'),
                'time' => date('H:i')
            ];
            notifyPublisher($notificationData,$user->id);
        }

        $update = User::find($id)->update($data);
        if ($update) {
            return redirect()->route('admin.publisherUsers')
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }
        
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            return Response::json($id);
        }
        return Response::json("false");
    }

}
