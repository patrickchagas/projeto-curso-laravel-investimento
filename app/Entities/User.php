<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use softDeletes;
    use Notifiable;

    public $timestamps = true;
    protected $table = 'users';
    protected $fillable = ['cpf', 'name', 'phone', 'birth', 'gender', 'notes', 'email', 'password', 'status', 'permission'];
    protected $hidden = ['password', 'remember_token'];

    public function groups()
    {
        //RELACIONAMENTO N:N
        return $this->belongsToMany(Group::class, 'user_groups');

    }        

    //Criptografar a senha do usuário
    public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = env('PASSWORD_HASH') ? bcrypt($value) : $value;
    }
    
    //Setar formatação do cpf
    public function getFormattedCpfAttribute()
    {   
        $cpf = $this->attributes['cpf'];    
        
        return substr($cpf, 0, 3) . '.' .substr($cpf, 3, 3) . '.' . substr($cpf, 7, 3) . '-' . substr($cpf, -2) ;
    }

    public function getFormattedPhoneAttribute()
    {

        $phone = $this->attributes['phone'];    

        return "(" . substr($phone, 0 , 2) .") " . substr($phone, 3, 4) . "-" . substr($phone, -4); 

    }

    public function getFormattedBirthAttribute()
    {

        $birth = explode('-', $this->attributes['birth']);
        if(count($birth) != 3)
            return "";

            $birth = $birth['2'] . '/' . $birth['1'] . '/' . $birth['0'];
            return $birth;   


    }

}
