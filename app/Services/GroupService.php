<?php 

namespace App\Services;

use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Database\QueryException;
use Exception;
use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class GroupService
{   

    private $repository;
    private $validator;
    
    public function __construct(GroupRepository $repository, GroupValidator $validator)
    {
        
        $this->repository = $repository;
        $this->validator = $validator;
        
    }

    public function store(array $data)
    {

        try {

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $group = $this->repository->create($data);
            
            return [
                'success'=> true,
                'messages'=> "Grupo cadastrado.",
                'data'=>  $group,
            ];

        } catch (\Exception $e) {

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