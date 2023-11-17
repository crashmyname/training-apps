<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchTraining extends Model
{
    use HasFactory;
    public $table = 'schedule';
    protected $guarded = ['schedule_id'];
    protected $primaryKey = 'schedule_id';

    public function datatrain()
    {
        return $this->belongsTo(DataTrain::class,'schedule_id','schedule_id');
    }
}
