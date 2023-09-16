<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;

    protected $fillable = ["owner","asset_name","value","days","added_at","last_check_at","created_at","updated_at"];

    
}
