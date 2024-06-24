<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Professor;
use App\Rules\UniqueAluno;
use App\Rules\UniqueProfessor;
use Illuminate\Http\RedirectResponse;

class AdmController extends Controller
{
    public function cadastro()
    {
        $users = User::all();
        return view('cadastro', compact('users'));
    }

    // CADASTRANDO UM ALUNO
    public function createAluno(Request $request)
    {
        $id = $request->user_id;

        if(Aluno::where('user_id',$id)->exists()){
            return response()->json(['alerta' => 'Aluno já cadastrado.']);
        }else{
            Aluno::insert([
                'ra'=>$request->ra,
                'user_id'=>$request->user_id]);

            return response()->json(['sucesso' => 'Aluno cadastrado com sucesso!']);
        }
    }

    // CADASTRANDO UM PROFESSOR
    public function createProfessor(Request $request)
    {
        $id = $request->user_id;

        if(!Professor::where('user_id',$id)->exists()){
            Professor::insert([
                'rm'=> $request->rm,
                'user_id'=> $id
            ]);

            return response()->json(['sucesso' => 'Professor cadastrado com sucesso!']);
        }else{
            return response()->json(['alerta' => 'Professor já cadastrado.']);
        }
    }
}
