<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use App\Services\UserService;

class UsersController extends Controller
{   
    protected $service;
    protected $repository;

    public function __construct(UserRepository $repository, UserService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    public function index()
    {
        
        $users = $this->repository->all();

        return view('user.index', [
            'users' => $users
        ]);
    }

    public function store(UserCreateRequest $request)
    {   
        //criar um novo usuário atráves do Service
        $request = $this->service->store($request->all());
        //Verificar se houve sucesso ou falha
        $usuario = $request['success'] ? $request['data'] : null;

        //Passar mensagens para view
        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        //transferir o resultado para view
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }

  
    public function edit($id)
    {
        $user = $this->repository->find($id);

        return view('user.edit', [
            'user' => $user
        ]);
    }

   
    public function update(Request $request, $id)
    {
       
        //criar um novo usuário atráves do Service
        $request = $this->service->update($request->all(), $id);
        //Verificar se houve sucesso ou falha
        $usuario = $request['success'] ? $request['data'] : null;

        //Passar mensagens para view
        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        //transferir o resultado para view
        return redirect()->route('user.index');
        
    }


    
    public function destroy($id)
    {
        
        //remover um usuário por id
        $request = $this->service->destroy($id);

        //Passar mensagens para view
        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        //transferir o resultado para view
        return redirect()->route('user.index');

    }
}
