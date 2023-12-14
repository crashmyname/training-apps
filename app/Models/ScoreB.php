<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreB extends Model
{
    use HasFactory;
    public $table = 'nilaitraining_b';
    protected $guarded = ['score_b_id'];
    protected $primaryKey = 'score_b_id';
}
