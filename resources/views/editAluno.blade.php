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
    <form method="POST" action="{{ route('editar', $user->id) }}">
        @csrf
        @method('PATCH')
        <div class="global-container ">
            <div>
                <h3>Editar Usuário</h3>
            </div>
            <div class="main-login-input main-login-container">
                <div>
                    <label for="ra">RA:</label>
                    <input type="text" name="ra" id="ra" value="{{$user->aluno->ra}}">
                </div>
                <template id="id">
                    <input type="text" name="id" id="id" value="{{$user->id}}">
                </template>
                <div>
                    <label for="name">Nome:</label>
                    <input type="text" name="name" id="name" value="{{$user->name}}">
                </div>
                <div>
                    <label for="telefone">Telefone:</label>
                    <input type="text" name="telefone" id="telefone" value="{{$user->telefone}}">
                </div>
                <div>
                    <label for="cep">CEP:</label>
                    <input type="text" name="cep" id="cep" value="{{$user->cep}}">
                </div>
                <div>
                    <label for="endereco">Endereço:</label>
                    <input type="text" name="endereco" id="endereco" value="{{$user->endereco}}">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-login-container">Atualizar</button>
                </div>
            </div>
        </div>
    </form>
</main>
