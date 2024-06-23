@extends('layouts.header')
@section('conteudo')
    <header>
        <div class="header-container">
            <div>
                <a href="/dashboard"><h1>SISEDU 2024 - INTEGRA FATEC</h1></a>
            </div>
            @if(!Auth::user())
            <div>
                <a href="/login">
                    <button class="btn-container btn btn-primary">Login</button>
                </a>
                <a href="/register">
                    <button class="btn-container btn btn-primary">Registro</button>
                </a>
            </div>
            @else
            <div>
                @if(Auth::check() && auth()->user())
                <a href="{{route('profile.edit', auth()->user()->id)}}">
                    <button class="btn-container btn btn-primary">Perfil</button>
                </a>
                @endif
            </div>
            <div>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <a href="logout" onclick="event.preventDefault();this.closest('form').submit();">
                            <button class="btn-container btn btn-danger">Sair</button>
                        </a>
                    </form>
            </div>
            @endif
        </div>
    </header>

    <main>
        <div class="global-container">
            <div>
                <h3>Equipe: INTEGRA FATEC</h3>
            </div>
            <div class="main-home-li">
                <li>Aluno 1: Matheus de Lourenço Manzutti</li>
                <li>Aluno 2: Heryson Belkior de Andrade Ribeiro</li>
                <li>Aluno 3: Renan de Azevedo e Silva</li>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="padding:1rem;margin-right:0.5rem;">
            @if(auth()->check() && auth()->user()->professor || auth()->check() && auth()->user()->isAdmin())
                <a href="/alunos">
                    <button class="btn-container btn btn-primary">Listar Alunos</button>
                </a>
                <a href="/listar">
                    <button class="btn-container btn btn-primary">Listar Notas</button>
                </a>
                @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="/cadastrar">
                        <button class="btn-container btn btn-primary">Cadastrar</button>
                    </a>
                @endif
            @elseif (auth()->check())
                <a href="{{route('listNotas')}}">
                    <button class="btn-container btn btn-primary">Listar Notas</button>
                </a>
            @endif
        </div>
    </main>

