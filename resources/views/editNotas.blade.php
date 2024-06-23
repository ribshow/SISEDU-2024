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
        <form method="POST" action="{{route('editNota')}}">
            @csrf
            <div class="global-container ">
                <div style="display: flex; align-items: center; grid-gap: 20px;">
                    <div><h3>Lançar Notas</h3></div>
                </div>
                <div class="main-login-input main-login-container">
                    @foreach ($notas as $nota)
                    <div>
                        <select name="user_id" id="user_id">
                            <option value="{{$nota->aluno->id}}">{{$nota->aluno->user->name}}</option>
                        </select>
                    <div>
                        <label for="avaliacao1">Avaliação 1 (A1):</label>
                        <input name="av1" value="{{$nota->nota_a1}}"type="number" step="0.10">
                    </div>
                    <div>
                        <label for="avaliacao2">Avaliação 2 (A2):</label>
                        <input name="av2" value="{{$nota->nota_a2}}" value="{{$nota->nota_a2}}" type="number" step="0.10">
                    </div>
                    <div>
                       <label for="projeto1">Projeto 1 (P1):</label>
                       <input name="p1" value="{{$nota->nota_p1}}" type="number" step="0.10">
                    </div>
                    <div>
                       <label for="projeto2">Projeto 2 (P2):</label>
                       <input name="p2" value="{{$nota->nota_p2}}" type="number" step="0.10">
                    </div>
                    <div>
                       <label for="participacao">Participação Diária (PD):</label>
                       <input name="pd" value="{{$nota->nota_pd}}" type="number" step="0.10">
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
                @endforeach
            </div>
        </form>
    </main>
