<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessorAccount extends Model
{
    use HasFactory;

    protected $primaryKey = 'email_address';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'email_address',
        'admin_id',
        'last_name',
        'first_name',
        'middle_name',
        'position',
        'default_password',
        'dateacc_created',
    ];

    public function profile()
    {
        return $this->hasOne(AssessorProfile::class, 'email_address', 'email_address');
    }

    public function passwordChanges()
    {
        return $this->hasMany(ChangeAssessorPassword::class, 'email_address', 'email_address');
    }
}
