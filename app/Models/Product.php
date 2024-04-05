<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'name',
        'grade',
        'email',
        'phone',
        'course',
        'dob',
        'detail',
        'title',
        'university_id'];

        public function university(): BelongsTo {
            return $this->belongsTo(Universities::class, 'university_id', 'id');
        }




}
