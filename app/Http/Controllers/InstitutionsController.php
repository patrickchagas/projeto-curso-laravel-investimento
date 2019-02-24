<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstitutionCreateRequest;
use App\Http\Requests\InstitutionUpdateRequest;
use App\Repositories\InstitutionRepository;
use App\Validators\InstitutionValidator;
use App\Services\InstitutionService;

/**
 * Class InstitutionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstitutionsController extends Controller
{

    protected $repository;
    protected $validator;
    protected $service;


    public function __construct(InstitutionRepository $repository, InstitutionValidator $validator, InstitutionService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = $this->repository->all();
        
        return view('institutions.index', [
            'institutions'=> $institutions,
        ]);
    }

    
    public function store(InstitutionCreateRequest $request)
    {
        
        //criar uma nova instituição atráves do Service
        $request = $this->service->store($request->all());
        //Verificar se houve sucesso ou falha
        $institution = $request['success'] ? $request['data'] : null;

        //Passar mensagens para view
        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        //transferir o resultado para view
        return redirect()->route('institution.index');

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
        $institution = $this->repository->find($id);

        return view('institutions.show', [
            'institution' => $institution
        ]);
       
    }

    public function edit($id)
    {
        $institution = $this->repository->find($id);

        return view('institutions.edit', [
            'institution' => $institution
        ]);
    }

   
    public function update(Request $request, $id)
    {
        
        //criar uma nova instituição atráves do Service
        $request = $this->service->update($request->all(), $id);
        //Verificar se houve sucesso ou falha
        $institution = $request['success'] ? $request['data'] : null;

        //Passar mensagens para view
        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        //transferir o resultado para view
        return redirect()->route('institution.index');

    }



    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        return redirect()->route('institution.index');
    }
}
