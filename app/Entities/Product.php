<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Product extends Model implements Transformable
{
    use TransformableTrait;

    //fillable-> forma de fazer o cadastro sem ficar instânciando atributo por atributo

    protected $fillable = [
        'institution_id',
        'name',
        'description',
        'index',
        'interest_rate'
    ];

    public function institution()
    {
        // isso quer dizer que o produto pertence a alguma instituição
        return $this->belongsTo(Institution::class);

    }

}
