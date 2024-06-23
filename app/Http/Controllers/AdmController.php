<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Professor;
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
        Aluno::insert(['ra'=>$request->ra,
                       'user_id'=>$request->user_id]);

        return response()->json(['sucesso' => 'Aluno cadastrado com sucesso!']);
    }

    // CADASTRANDO UM PROFESSOR
    public function createProfessor(Request $request)
    {
        Professor::insert(['rm'=>$request->rm,
                           'user_id'=>$request->user_id]);

        return response()->json(['sucesso' => 'Professor cadastrado com sucesso!']);
    }
}
