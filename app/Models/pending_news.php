<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pending_news extends Model
{
    use HasFactory;
    protected $fillable =['link', 'link_hash', 'processed', 'scrap_timestamp', 'processed_timestamp'];
}
