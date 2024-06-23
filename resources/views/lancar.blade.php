@extends('layouts.header')
@section('conteudo')
    <header>
        <div class="header-container">
            <div>
                <a href="/dashboard"><h1>SISEDU 2024 - INTEGRA FATEC</h1></a>
            </div>
            <div>
                <a href="/listar">
                    <button class="btn-container btn btn-primary">Listar Notas</button>
                </a>
            </div>
        </div>
    </header>

    <main>
        <form class="forms" method="POST" action="{{route('store')}}">
            @csrf
            <div class="global-container ">
                <div style="display: flex; align-items: center; grid-gap: 20px;">
                    <div><h3>Lançar Notas</h3></div>
                </div>
                <div class="main-login-input main-login-container">
                    <div>
                        <label for="nome_aluno">Nome do aluno:</label>
                        <select name="user_id" id="user_id">
                        <option value="selecione">Selecione</option>
                        @foreach($users as $user)
                            <option value="{{$user->user->id}}">{{$user->user->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="avaliacao1">Avaliação 1 (A1):</label>
                        <input name="av1" type="number" step="0.10">
                    </div>
                    <div>
                        <label for="avaliacao2">Avaliação 2 (A2):</label>
                        <input name="av2" type="number" step="0.10">
                    </div>
                    <div>
                        <label for="projeto1">Projeto 1 (P1):</label>
                        <input name="p1" type="number" step="0.10">
                    </div>
                    <div>
                        <label for="projeto2">Projeto 2 (P2):</label>
                        <input name="p2" type="number" step="0.10">
                    </div>
                    <div>
                        <label for="participacao">Participação Diária (PD):</label>
                        <input name="pd" type="number" step="0.10">
                    </div>
                    <div>
                        <label for="">Média Final Aritmética (MFA):</label>
                        <input style="background-color: rgb(210, 210, 210);" type="text" disabled>
                    </div>
                    <div>
                        <label for="">Média Final Ponderada (MFP):</label>
                        <input style="background-color: rgb(210, 210, 210);" type="text" disabled>
                    </div>
                    <div>
                        <button type="reset" class="btn btn-secondary btn-login-container">LIMPAR</button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-login-container">LANÇAR</button>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <script>
        // SCRIPT AJAX PARA LIDAR COM AS REQUISÇÕES CARREGANDO OU NÃO
        // A PÁGINA DEPENDENDO DO QUE ACONTECER NO CONTROLADOR
       document.querySelectorAll('.forms').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(this);
                const action = this.action;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.alerta) {
                        alert(data.alerta);
                    }else if(data.redirect){
                        window.location.href = data.redirect;
                    }
                })
                .catch(error => console.error('Erro', error));
            });
        });
    </script>
