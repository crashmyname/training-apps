<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTrain extends Model
{
    use HasFactory;
    public $table = 'tbtraining';
    protected $guarded = ['train_id'];
    protected $primaryKey = 'train_id';

    public function schtraining()
    {
        return $this->hashMany(SchTraining::class,'schedule_id','schedule_id');
    }
}
