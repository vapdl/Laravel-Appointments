<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'nday',
        'employee_id',
        'start',
        'end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function consultation_employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
