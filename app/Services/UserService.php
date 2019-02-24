<?php 

namespace App\Services;

use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Database\QueryException;
use Exception;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class UserService
{

    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {   

       $this->repository = $repository;
       $this->validator = $validator; 

    }

    public function store($data)
    {

        
        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
        $usuario = $this->repository->create($data);

        try {

            return [
                'success'=> true,
                'messages'=> "Usuário cadastrado.",
                'data'=>  $usuario,
            ];
            
            
        } catch (Exception $e) {
            
            switch(get_class($e))
            {

                case QueryException::class       :  return ['success' => false, 'messages' =>  $e->getMessage()];
                case ValidatorException::class   :  return ['success' => false, 'messages' =>  $e->getMessageBag()]; 
                case Exception::class            :  return ['success' => false, 'messages' =>  $e->getMessage()];
                default                          :  return ['success' => false, 'messages' =>  $e->getMessage()];                         


            }

        }

    }



    public function update($data, $id)
    {

        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
        $usuario = $this->repository->update($data, $id);

        try {

            return [
                'success'=> true,
                'messages'=> "Usuário atualizado.",
                'data'=>  $usuario,
            ];
            
            
        } catch (Exception $e) {
            
            switch(get_class($e))
            {

                case QueryException::class       :  return ['success' => false, 'messages' =>  $e->getMessage()];
                case ValidatorException::class   :  return ['success' => false, 'messages' =>  $e->getMessageBag()]; 
                case Exception::class            :  return ['success' => false, 'messages' =>  $e->getMessage()];
                default                          :  return ['success' => false, 'messages' =>  $e->getMessage()];                         


            }

        }


    } 
        
    //Deletar um usuário    
    public function destroy($user_id)
    {

        $this->repository->deleteWhere(['id' => $user_id]);

        try {

            return [
                'success'=> true,
                'messages'=> "Usuário removido.",
                'data'=>  null,
            ];
            
            
        } catch (Exception $e) {
            
            switch(get_class($e))
            {

                case QueryException::class       :  return ['success' => false, 'messages' =>  $e->getMessage()];
                case ValidatorException::class   :  return ['success' => false, 'messages' =>  $e->getMessageBag()]; 
                case Exception::class            :  return ['success' => false, 'messages' =>  $e->getMessage()];
                default                          :  return ['success' => false, 'messages' =>  $e->getMessage()];                         


            }

        }
    }
    

}


?>