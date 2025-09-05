<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPassword extends Model
{
    protected $fillable = ['admin_id', 'password_hashed', 'date_pass_created'];

    public function admin() {
        return $this->belongsTo(AdminProfile::class, 'admin_id');
    }
}
