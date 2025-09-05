<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    protected $primaryKey = 'admin_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'admin_id', 'email_address', 'name', 'contact_number',
        'position', 'picture_path', 'date_upload'
    ];

    public function accounts() {
        return $this->hasMany(ManageAccount::class, 'admin_id');
    }

    public function passwords() {
        return $this->hasMany(AdminPassword::class, 'admin_id');
    }

    public function passwordChanges() {
        return $this->hasMany(ChangeAdminPassword::class, 'admin_id');
    }
}
