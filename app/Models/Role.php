<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const TYPE_USER = 1;
    const TYPE_ADMIN = 2;
    const TYPE_ACCOUNT= 3;

    protected $fillable = ['title'];

    public function users()
    {
        return $this->hasMany(User::class);
    }


}
