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
                <a href="/listar">
                    <button class="btn-container btn btn-success">Listar Notas</button>
                </a>
                <form class="btn-container btn" method="POST" action="{{route('logout')}}">
                    @csrf
                        <button class="btn-container btn btn-danger">Sair</button>
                </form>
            </div>
        </div>
    </header>

    <main>
        <div class="global-container">
            <h1 style="text-align: center;">Listar Alunos</h1>
            <table class="table">
                <thead>
                    <tr class="la-trhead">
                        <td class="la-trtd-1">RA</td>
                        <td class="la-trtd-2">Nome</td>
                        <td class="la-trtd-3">E-mail</td>
                        <td class="la-trtd-4">Telefone</td>
                        <td class="la-trtd-5">Operações</td>
                    </tr>
                </thead>
                <tfoot>
                    @foreach($users as $user)
                    <tr class="la-trfoot">
                        <td>{{$user->ra}}</td>
                        <td>{{$user->user->name}}</td>
                        <td>{{$user->user->email}}</td>
                        <td>{{$user->user->telefone}}</td>
                        <td>
                            <div>
                                <a href="{{route('editar', $user->user->id)}}">
                                    <button class="btn btn-primary btn-la-container">
                                        Editar
                                    </button>
                                </a>
                                <form id="forms" class="btn btn-la-container" method="POST" action="{{route('delete', $user->user->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary btn-la-container">
                                        Remover
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tfoot>
            </table>
        </div>
    </main>
<script>
    // REQUISIÇÃO AJAX PARA EXCLUIR USUÁRIO E NÃO RECARREGAR A PÁGINA
      document.querySelectorAll('.la-trfoot form').forEach(form => {
        form.addEventListener('submit', function(event) {
        event.preventDefault();

        if (confirm('Tem certeza que deseja remover esse aluno?')) {
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
                    alert('Ocorreu um erro ao excluir esse aluno!');
                }
            })
            .catch(error => console.error('Erro', error));
        }
    });
});
</script>
