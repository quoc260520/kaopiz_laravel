<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrm extends Model
{
    use HasFactory;

    protected $table="users_orm";
    const DEFAULT_PAGINATE = 10;

    public function phone()
    {
        return $this->hasOne(Phone::class,'user_id');
    }

    public function roleUser()
    {
        return $this->hasOne(RoleUser::class, 'user_id');
    }

    public function scopeWithFilter($query, $filters)
    {
        [
            'id' => $id,
            'name' => $name,
            'class' => $class,
        ] = $filters;

        if ($id) {
            $query = $query->where('id', $id);
        }
        if ($class) {
            $query = $query->where('class','like', '%'.$class.'%');
        }
        if ($name) {
            $query = $query->where('name', 'like', '%'.$name.'%');
        }

        return $query;
    }

}
