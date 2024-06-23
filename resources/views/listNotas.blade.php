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
        <div class="global-container">
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
                    </tr>
                </thead>
                <tfoot>
                    @foreach($mediasFinais as $mf)
                    <tr class="la-trfoot">
                        <td>{{$mf['nota']->aluno->ra}}</td>
                        <td>{{$mf['nota']->aluno->user->name}}</td>
                        <td>{{$mf['nota']->nota_a1}}</td>
                        <td>{{$mf['nota']->nota_a2}}</td>
                        <td>{{$mf['nota']->nota_p1}}</td>
                        <td>{{$mf['nota']->nota_p2}}</td>
                        <td>{{$mf['nota']->nota_pd}}</td>
                        <td>{{round($mf['mediaA'], 2)}}</td>
                        <td>{{round($mf['mediaP'], 2)}}</td>
                    </tr>
                    @endforeach
                </tfoot>
            </table>
        </div>
    </main>
