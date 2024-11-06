<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'nom',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }
}
