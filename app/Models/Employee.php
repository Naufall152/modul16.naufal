<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    // Nama tabel, jika tidak sesuai konvensi Laravel
    protected $table = 'employees';

    // Atribut yang dapat diisi secara massal
    // protected $fillable = [
    //     'firstname',
    //     'lastname',
    //     'email',
    //     'age',
    //     'position_name',
    // ];
    protected $guarded = [];

    // Jika Anda memiliki atribut lain yang perlu di-cast
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
