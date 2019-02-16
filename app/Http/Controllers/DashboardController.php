<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Auth;
use Exception;

class DashboardController extends Controller
{

  private $repository;
  private $validator;

  public function __construct(UserRepository $repository, UserValidator $validator)
  {
      $this->repository = $repository;
      $this->validator  = $validator;
  }

  public function index()
  {

    return view('user.dashboard');

  }

  // method login auth
  public function auth(Request $request)
  {
      $data = [
        'email' => $request->get('username'),
        'password' => $request->get('password')
      ];

      try {

        if(env('PASSOWORD_HASH'))
        {

          \Auth::attempt($data , false);

        } else {
          //Buscar email
          $user = $this->repository->findWhere(['email' => $request->get('username')])->first();
          

          if(!$user) // não encontrou o usuário
              throw new Exception("E-mail informado é inválido ou não existe.");
          
          if($user->password != $request->get('password'))
              throw new Exception("A senha informada é inválida.");          

            Auth::login($user);

        }

        return redirect()->route('user.dashboard');

      } catch (Exception $e) {

        return $e->getMessage();

      }

  }

}
