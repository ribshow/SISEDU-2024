@extends('layouts.header')
@section('conteudo')
    <header>
        <div class="header-container">
            <div>
                <a href="/dashboard">
                    <h1>SISEDU 2024 - INTEGRA FATEC</h1>
                </a>
            </div>
            <div>
                @if(auth()->user()->professor || auth()->user()->isAdmin())
                <a href="/alunos">
                    <button class="btn-container btn btn-primary">Listar Alunos</button>
                </a>
                @endif
                <form class="btn-container btn" method="POST" action="{{route('logout')}}">
                    @csrf
                    <button
                    onclick="event.preventDefault();this.closest('form').submit();"
                    class="btn-container btn btn-danger">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main>
        <div class="global-container">
            <div style="align-items: center;">
                <div style="text-align: right;">
                    @if(auth()->user()->professor || auth()->user()->isAdmin())
                    <a href="/lancar">
                        <button class="btn btn-primary btn-la-container">
                            Lançar Notas
                        </button>
                    </a>
                    @endif
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr class="la-trhead">
                        <td class="la-trtd-1">RA</td>
                        <td class="la-trtd-2">Nome</td>
                        <td class="la-trtd-3">A1</td>
                        <td class="la-trtd-4">A2</td>
                        <td class="la-trtd-5">P1</td>
                        <td class="la-trtd-5">P2</td>
                        <td class="la-trtd-5">PD</td>
                        <td class="la-trtd-5">MFA</td>
                        <td class="la-trtd-5">MFP</td>
                        @if(auth()->user()->professor || auth()->user()->isAdmin())
                        <td class="la-trtd-5">Operações c/ Notas</td>
                        @endif
                    </tr>
                </thead>
                <tfoot>
                    @foreach ($mediasFinais as $item)
                    <tr class="la-trfoot">
                        <td>{{ $item['nota']->aluno->ra }}</td>
                        <td>{{ $item['nota']->aluno->user->name }}</td>
                        <td>{{ $item['nota']->nota_a1 }}</td>
                        <td>{{ $item['nota']->nota_a2 }}</td>
                        <td>{{ $item['nota']->nota_p1 }}</td>
                        <td>{{ $item['nota']->nota_p2 }}</td>
                        <td>{{ $item['nota']->nota_pd }}</td>
                        <td>{{ round($item['mediaAritmetica'], 2) }}</td>
                        <td>{{ round($item['mediaPonderada'], 2) }}</td>
                        @if(auth()->check() && (auth()->user()->professor || auth()->user()->isAdmin()))
                            <td>
                                <div>
                                    <a href="{{route('viewNota', $item['nota']->aluno->user_id)}}">
                                        <button class="btn btn-primary btn-la-container">Editar</button>
                                    </a>
                                    <form id="forms" class="btn btn-la-container" method="POST" action="{{route('deleteN', $item['nota']->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-primary btn-la-container">
                                            Remover
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tfoot>
            </table>
        </div>
    </main>
    <script>
        // REQUISIÇÃO AJAX PARA EXCLUIR USUÁRIO E NÃO RECARREGAR A PÁGINA
          document.querySelectorAll('#forms').forEach(form => {
            form.addEventListener('submit', function(event) {
            event.preventDefault();

            if (confirm('Tem certeza que deseja deletar as notas desse aluno?')) {
                const action = this.action;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(action, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.sucesso) {
                        this.closest('.la-trfoot').remove();
                        alert(data.sucesso);
                    } else {
                        alert('Ocorreu um erro ao excluir essas notas!');
                    }
                })
                .catch(error => console.error('Erro', error));
            }
        });
    });
    </script>
