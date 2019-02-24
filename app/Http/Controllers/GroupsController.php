<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Repositories\GroupRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\UserRepository;
use App\Validators\GroupValidator;
use App\Services\GroupService;


class GroupsController extends Controller
{

    protected $userRepository;
    protected $institutionRepository;
    protected $repository;
    protected $validator;
    protected $service;

    public function __construct(GroupRepository $repository, GroupValidator $validator, GroupService $service, InstitutionRepository $institutionRepository, UserRepository $userRepository)
    {   
        $this->userRepository = $userRepository;
        $this->institutionRepository = $institutionRepository;
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service  = $service;
    }

 
    public function index()
    {
       
        $groups = $this->repository->all();

        $user_list = $this->userRepository->selectBoxList();
        $institution_list = $this->institutionRepository->selectBoxList();
        
        return view('groups.index', [
            'groups'=> $groups,
            'user_list'=> $user_list,
            'institution_list'=>$institution_list
        ]);
    }

    public function store(GroupCreateRequest $request)
    {
        
        //criar uma novo grupo atráves do Service
        $request = $this->service->store($request->all());
        //Verificar se houve sucesso ou falha
        $group = $request['success'] ? $request['data'] : null;

        //Passar mensagens para view
        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        //transferir o resultado para view
        return redirect()->route('group.index');

    }

    public function userStore(Request $request, $group_id)
    {

        //criar uma novo grupo atráves do Service
        $request = $this->service->userStore($group_id, $request->all());

        //Passar mensagens para view
        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        //transferir o resultado para view
        return redirect()->route('group.show', [$group_id]);


    }

   
    public function show($id)
    {
        
        $group = $this->repository->find($id);
        $user_list = $this->userRepository->selectBoxList();

        return view('groups.show', [
            'group'=> $group,
            "user_list" => $user_list
        ]);                

    }

    public function update(GroupUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $group = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Group updated.',
                'data'    => $group->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }



    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        return redirect()->route('group.index');
    }
}
