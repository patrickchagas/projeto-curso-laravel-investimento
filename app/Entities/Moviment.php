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

    //Só vai trazer os produtos
    public function scopeProducts($query, $product)
    {

        return $query->where('product_id', $product->id); 

    }

    //Só vai trazer aplicações financeiras
    public function scopeApplications($query)
    {

        return $query->where('type', 1); 

    }

    //Só vai trazer resgastes financeiros
    public function scopeOutFlows($query)
    {

        return $query->where('type', 2);

    }

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
