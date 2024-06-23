<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">

    <title>SISEDU 2024</title>
</head>
<body>
    <header>
        <div class="header-container">
            <div>
                <a href="/dashboard"><h1>SISEDU 2024 - INTEGRA FATEC</h1></a>
            </div>
            <div>
                <a href="{{route('login')}}">
                    <button class="btn-container btn btn-primary">Entrar</button>
                </a>
            </div>
        </div>
    </header>

    <main>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="global-container ">
                <div>
                    <h3>Cadastro do Usuário</h3>
                </div>
                <div class="main-login-input main-login-container">
                <div>
                        <label for="name">Nome:</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div>
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div>
                        <label for="telefone">Telefone:</label>
                        <input type="text" name="telefone" id="telefone">
                    </div>
                    <div>
                        <label for="cep">CEP:</label>
                        <input type="text" name="cep" id="cep">
                    </div>
                    <div>
                        <label for="endereco">Endereço:</label>
                        <input type="text" name="endereco" id="endereco">
                    </div>
                    <div>
                        <label for="password">Senha:</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div>
                        <label for="password_confirmation">Senha:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-login-container">Registrar</button>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <footer>
        <div class="footer-container">
            <div>
                © Todos os direitos reservados 2024. Equipe: INTEGRA FATEC
            </div>
            <div>
                Faculdade de Tecnologia de Jahu
            </div>
        </div>
    </footer>
</body>
</html>
