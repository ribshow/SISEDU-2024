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
    <form id="cadAluno" action="{{route('criar')}}" method="POST" class="global-container">
        @csrf
        @method('POST')
        <h3>Cadastrar Aluno</h3>
        <div class="main-login-input main-login-container" id="step1">
            <div>
                <label for="ra">RA:</label>
                <input type="text" id="ra" name="ra" required>
            </div>
            <div>
                <label for="user">Usuário:</label>
                <select id="user_id" name="user_id">
                    <option value="">-- Selecionar --</option>
                    @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>

                <div>
                    <button type="reset" class="btn btn-secondary btn-login-container">LIMPAR</button>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-login-container">CADASTRAR</button>
                </div>
            </div>
    </form>
</main>
<main>
    <form id="cadProf" method="POST" action="{{route('criar_prof')}}" class="global-container">
        @csrf
        @method('POST')
        <h3>Cadastrar Professor</h3>
        <div class="main-login-input main-login-container" id="step1">
            <div>
                <label for="rm">RM:</label>
                <input type="text" id="rm" name="rm" required>
            </div>
            <div>
                <label for="user">Usuário:</label>
                <select id="user_id" name="user_id">
                    <option value="">-- Selecionar --</option>
                    @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>

                <div>
                    <button type="reset" class="btn btn-secondary btn-login-container">LIMPAR</button>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-login-container">CADASTRAR</button>
                </div>
            </div>
    </form>
</main>
<script>
    // REQUISIÇÃO AJAX PARA CADASTRAR UM ALUNO
    // REQUISIÇÃO AJAX PARA CADASTRAR UM ALUNO
    const cadAluno = document.querySelector('#cadAluno');
    cadAluno.addEventListener('submit', function(event) {
        event.preventDefault();

        if (confirm('Deseja realmente cadastrar esse aluno?')) {
            const action = this.action;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const formData = new FormData(this);

            fetch(action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.sucesso) {
                    alert(data.sucesso);
                } else if (data.alerta) {
                    alert(data.alerta);
                } else {
                    alert('Resposta inesperada do servidor.');
                }
            })
            .catch(error => console.error('Erro:', error));
        }
    });


        // REQUISIÇÃO AJAX PARA CADASTRAR UM PROFESSOR
        const cadProf = document.querySelector('#cadProf');
            cadProf.addEventListener('submit', function(event) {
            event.preventDefault();

            if (confirm('Deseja realmente cadastrar esse professor?')) {
                const action = this.action;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const formData = new FormData(this);

                fetch(action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.sucesso) {
                        alert(data.sucesso);
                    } else if (data.alerta) {
                        alert(data.alerta);
                    } else {
                        alert('Resposta inesperada do servidor.');
                    }
                })
                .catch(error => console.error('Erro:', error));
            }
        });
</script>

