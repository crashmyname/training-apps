<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreA extends Model
{
    use HasFactory;
    public $table = 'nilaitraining_a';
    protected $guarded = ['score_a_id'];
    protected $primaryKey = 'score_a_id';
}
