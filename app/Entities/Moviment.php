<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Moviment extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id',
        'group_id',
        'product_id',
        'value',
        'type',
    ];

    //Descobrir quem é o usuário 
    public function user()
    {

        return $this->belongsTo(User::class);

    }
    
   //Descobrir qual é o grupo
    public function group()
    {

        return $this->belongsTo(Group::class);

    }

    //Descobrir qual é o produto
    public function product()
    {

        return $this->belongsTo(Product::class);

    }

}
