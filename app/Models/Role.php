<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $table = 'role';
    protected $guarded = ['id_role'];
    protected $primaryKey = 'id_role';

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
