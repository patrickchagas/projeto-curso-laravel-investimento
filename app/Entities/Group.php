<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Group extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name', 'user_id', 'institution_id'];
    
    public function owner()
    {

        return $this->belongsTo(User::class, 'user_id');

    }    

    public function institution()
    {

        return $this->belongsTo(Institution::class, 'institution_id');

    }

}
