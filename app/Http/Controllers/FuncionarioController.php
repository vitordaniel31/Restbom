<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionarios = User::all();
        return view('funcionario.index')->with('funcionarios', $funcionarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $funcionario = User::find($id);
        if ($funcionario) {
            return view('funcionario.edit')->with('funcionario', $funcionario);
        }else{
            //retornar mensagem de erro para a página index de funcionarios
            return redirect(route('funcionario.index').'#registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $id . ',id',
            'tipo_perfil' => 'string|in:C,D,G',
        ]);

        $user = User::find($id);

        if ($user) {
            if ($user->tipo_perfil!='A') {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'tipo_perfil' => $request->tipo_perfil,
                ]); 
                return redirect(route('funcionario.index').'#funcionarios');
            }else{
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]); 
                return redirect(route('funcionario.index').'#funcionarios');
            }
            
        }else{
            //retornar mensagem de erro para a página index de funcionarios
            return redirect(route('funcionario.index').'#funcionarios');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
