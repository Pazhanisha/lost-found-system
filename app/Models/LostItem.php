<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'item_name',
    'description',
    'location',
    'contact_number',
    'status',
    'date',
    'image',
];
}