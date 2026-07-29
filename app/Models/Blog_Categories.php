<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_Categories extends Model
{
    use HasFactory;
    
    protected $table = 'blog_categories';
    
    protected $guarded = [];
     
    
    public function hasCreatedBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
   
}
