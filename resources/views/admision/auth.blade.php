@extends('layouts.app')

@section('title', 'Login Admision')

@section('content')
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Raleway, sans-serif;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            flex-wrap: nowrap;
        }

        .screen {
            position: relative;
            height: 600px;
            width: 360px;
        }

        .screen__content {
            z-index: 1;
            position: relative;
            height: 100%;
        }

        .screen__background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            clip-path: inset(0 0 0 0);
            overflow: hidden;
        }

        .screen__background__shape {
            transform: rotate(45deg);
            position: absolute;
        }

        .screen__background__shape1 {
            height: 520px;
            width: 520px;
            background: #FFF;
            top: -50px;
            right: 120px;
            border-radius: 0 72px 0 0;
        }

        .screen__background__shape2 {
            height: 220px;
            width: 220px;
            background: #55ade8;
            top: -172px;
            right: 0;
            border-radius: 32px;
        }

        .screen__background__shape3 {
            height: 540px;
            width: 190px;
            background: linear-gradient(270deg, #2b4c7e, #2b4c7e);
            top: -24px;
            right: 0;
            border-radius: 32px;
        }

        .screen__background__shape4 {
            height: 400px;
            width: 200px;
            background: #f9dd44;
            top: 420px;
            right: 50px;
            border-radius: 60px;
        }

        .login {
            width: 320px;
            padding: 30px;
            padding-top: 80px;
        }

        .login__field {
            padding: 10px 0px;
            position: relative;
        }

        .logo {
            position: absolute;
            width: 140px;
            text-align: center;
            bottom: 0px;
            right: 0px;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>

    <div class="container">
        <div class="screen">
            <div class="screen__content ring-1 ring-gray-200">
                <form class="login" method="POST" action="{{ route('login') }}">
                    <h3 class="text-3xl font-semibold leading-10 text-gray-900">SISTEMA ACADÉMICO</h3>
                    @csrf
                    <div class="login__field mt-4">
                        <input type="text" name="usuario" required id="email"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                            placeholder="Usuario">
                    </div>
                    <div class="login__field mb-4">
                        <input type="password" name="password" required id="password"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                            placeholder="Contraseña">
                    </div>
                    @error('usuario')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <button
                        class="py-2.5 px-5 me-2 mb-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-500">Iniciar
                        Sesion</button>
                </form>
                <div class="logo">
                    <h3>UNPRG</h3>
                    <img class="pb-2" src="{{ asset('images/favicon.ico') }}" alt="unprg" width="85">
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
@endsection
