<?php


namespace Elijahcruz\Laralytics\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laralytics extends Model
{
    use HasFactory;
    
    protected $table = 'laralytics';
    
    protected $fillable = ['path', 'data', 'realtime'];
    
}
