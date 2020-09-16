<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string logo
 * @property string description
 * @property string created_at
 * @property string updated_at
 * @property User users
 */
class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
