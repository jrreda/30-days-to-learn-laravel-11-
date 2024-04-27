<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function jobs() {
        return $this->hasMany(Job::class);
    }
}