<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\UserOrm;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserOrmController extends Controller
{
    public function user(Request $request){
        $request->validate(
            [
                'name' => 'max:100',
                'class' => 'max:100'
            ],
        );
        $filters = [
            'id' => $request->id,
            'name' => $request->name,
            'class' => $request->class
        ];
       
        $users = UserOrm::withFilter($filters) 
        ->orderByDesc('created_at')
        ->paginate(UserOrm::DEFAULT_PAGINATE);

        return view('user.list_user')->with(compact('users'));
    }

    public function user_tp2(Request $request){
        $request->validate(
            [
                'phone' => 'max:11',
            ],
        );
        $filters = [
            'id' => $request->id,
            'phone' => $request->phone,
            'role_name' => $request->role_name
        ];

        $users = UserOrm::with('phone','roleUser.role');

        if($filters['id']){
            $users = $users->where('id',$filters['id']);
        }
        if($filters['phone']){
            $users = $users->whereHas('phone',function (Builder $query) use ($filters) {
                $query->where('number', $filters['phone']);
            });
        }
        if($filters['role_name']){
            $users = $users->whereHas('roleUser.role',function (Builder $query) use ($filters) {
                $query->where('name', $filters['role_name']);
            });
        }
        $users = $users->orderByDesc('created_at')
        ->paginate(UserOrm::DEFAULT_PAGINATE);
        return view('user.list_user_tp2')->with(compact('users'));
    }
}
