<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Nota;
use App\Models\Aluno;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // PASSANDO ALUNOS PARA TER NOTAS LANÇADAS
    public function notas()
    {
        $null = null;
        $users = Aluno::where('deleted_at',$null)->get();
        return view('lancar' , compact('users'));
    }

    // PASSANDO OS ALUNOS PARA EXIBIR NA LISTAGEM DE ALUNOS
    public function alunos()
    {
        $users = Aluno::all();
        return view('alunos', compact('users'));
    }

    // PASSANDO ALUNOS E NOTAS PARA EXIBIR NA LISTAGEM DAS NOTAS
    public function listar()
    {
        // Obter todas as notas com seus respectivos alunos e usuários associados
        $notas = Nota::with('aluno.user')->get();

        // Array para armazenar as médias finais
        $mediasFinais = [];

        foreach ($notas as $nota) {
            // Cálculo da média aritmética para cada aluno
            $mediaAritmetica =
            ($nota->nota_a1 + $nota->nota_a2 + $nota->nota_p1 + $nota->nota_p2 + $nota->nota_pd) / 5;

            // Cálculo da média ponderada para cada aluno
            $mediaPonderada =
                ($nota->nota_a1 * 0.15) + ($nota->nota_a2 * 0.15) +
                ($nota->nota_p1 * 0.2) + ($nota->nota_p2 * 0.2) +
                ($nota->nota_pd * 0.3);

            // Adicionar as médias calculadas ao array $mediasFinais
            $mediasFinais[] = [
                'nota' => $nota,
                'mediaAritmetica' => $mediaAritmetica,
                'mediaPonderada' => $mediaPonderada,
            ];
        }

        return view('listar', compact('mediasFinais'));
    }

    // NOTAS ESPECIFICAS DE UM ALUNO
    public function listNotas()
    {
        $id = Auth::id();
        $notas = Nota::where('aluno_id', $id)->get();

        $totalPeso = 0.15 + 0.15 + 0.2 + 0.2 + 0.3;
        $mediasFinais = [];

        foreach ($notas as $nota) {
            // Cálculo da soma ponderada para cada nota
            $somaPonderada =
                ($nota->nota_a1 * 0.15) +
                ($nota->nota_a2 * 0.15) +
                ($nota->nota_p1 * 0.2) +
                ($nota->nota_p2 * 0.2) +
                ($nota->nota_pd * 0.3);

            // Cálculo da soma aritmética para cada nota
            $somaAritmetica =
                $nota->nota_a1 +
                $nota->nota_a2 +
                $nota->nota_p1 +
                $nota->nota_p2 +
                $nota->nota_pd;

            // Calcular médias para cada nota
            $mediaP = $somaPonderada; // Já está ponderada pela soma dos pesos
            $mediaA = $somaAritmetica / 5; // Média aritmética simples

            $mediasFinais[] = [
                'nota' => $nota,
                'mediaP' => $mediaP,
                'mediaA' => $mediaA,
            ];
        }

        return view('listNotas', compact('mediasFinais'));
    }

    // INSERINDO AS NOTAS DO ALUNO
    public function store(Request $request)
    {
        $id = $request->user_id;

        $existeNota = Nota::where('aluno_id',$id)->exists();
        if($existeNota)
        {
            return response()->json(['alerta'=>'Usuário já possuí notas cadastradas!']);
        }else{
            Nota::insert(['nota_a1'=>$request->av1,
                      'nota_a2'=>$request->av2,
                      'nota_p1'=>$request->p1,
                      'nota_p2'=>$request->p2,
                      'nota_pd'=>$request->pd,
                      'aluno_id'=> $request->user_id]);

            return response()->json(['redirect' => route('listar')]);
        }
    }

    // EDITANDO O USUÁRIO
    public function edit_user(Request $request): RedirectResponse
    {
        $user = User::findOrFail($request->id);
        $aluno = Aluno::where('user_id',$request->id)->firstOrFail();


        $request->validate([
            'ra' => ['required', 'string', 'max:15','unique:alunos,ra,'.$aluno->user_id],
            'name' => ['required', 'string', 'max:100'],
            'telefone' => ['required', 'string', 'max:20','unique:users,telefone,'.$user->id],
            'cep' => ['required','string','max:11'],
            'endereco' => ['required', 'string', 'max:100'],
        ]);


        $user->name = $request->input('name');
        $user->telefone = $request->input('telefone');
        $user->cep = $request->input('cep');
        $user->endereco = $request->input('endereco');
        $user->save();

        $aluno->ra = $request->input('ra');
        $aluno->save();

        return redirect()->route('dashboard');
    }

    // PASSANDO ID DO USUÁRIO, PARA PREENCHER O VALOR DOS CAMPOS NA VIEW
    public function view_user($id)
    {
        $user = User::findOrFail($id);
        return view('editAluno', compact('user'));
    }

    // DELETANDO UM ALUNO
    public function delete($id)
    {
        $user = Aluno::where('user_id',$id)->firstOrFail();
        $user->delete();

        return response()->json(['sucesso' => 'Aluno removido com sucesso!']);
    }

    // RESTAURANDO UM ALUNO
    public function restore($id)
    {
        $aluno = Aluno::withTrashed()->where('user_id',$id)->firstOrFail();
        $aluno->restore();

        return response()->json(['Sucesso' => 'Aluno restaurado com sucesso!']);
    }

    // VIEW PARA EDITAR NOTAS JÁ CADASTRADAS
    public function editNotas($id)
    {
        $notas = Nota::where('aluno_id',$id)
                       ->with('aluno.user')
                       ->get();
        return view('editNotas', compact('notas'));
    }

    // EDITAR NOTAS JÁ CADASTRAS
    public function storeNotas(Request $request)
    {
        $notas = Nota::where('aluno_id',$request->user_id)->first();

        $notas->nota_a1 = $request->av1;
        $notas->nota_a2 = $request->av2;
        $notas->nota_p1 = $request->p1;
        $notas->nota_p2 = $request->p2;
        $notas->nota_pd = $request->pd;

        $notas->save();

        return redirect()->route('listar');
    }

    // EXCLUINDO AS NOTAS DO USUÁRIO
    public function destroyNota($id)
    {
        $nota = Nota::findOrFail($id);

        $nota->delete();

        return response()->json(['sucesso'=>'Notas apagadas com sucesso!']);
    }
}
