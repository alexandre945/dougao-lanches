<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressType extends Model
{
    use HasFactory;
    protected $fillable = [(
        'name'
    )];

    public function addressUserTypes()
    {
        return $this->hasMany(AddressUserType::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'address_user_types')
                    ->withPivot('address_id')
                    ->withTimestamps();
    }
}
