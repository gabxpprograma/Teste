<?php
// Verifica se há envio de dados de login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $users = file('users.txt', FILE_IGNORE_NEW_LINES); // Carrega os usuários do arquivo
    foreach ($users as $user) {
        list($saved_username, $saved_password) = explode('|', $user);
        if ($username === $saved_username && $password === $saved_password) {
            echo 'Login bem-sucedido!';
            exit;
        }
    }
    echo 'Nome de usuário ou senha incorretos.';
}

// Verifica se há envio de dados de cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $file = fopen('users.txt', 'a');
    fwrite($file, "$username|$password\n");
    fclose($file);
    echo 'Cadastro realizado com sucesso!';
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login e Cadastro</title>
    <style>
        /* CSS aqui */
        /* Coloque o CSS dentro das tags <style>...</style> */
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #signup-form {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="login-form">
            <h2>Login</h2>
            <form id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="login" value="1">
                <input type="text" name="username" placeholder="Nome de usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <button type="submit">Entrar</button>
            </form>
        </div>
        <div id="signup-form">
            <h2>Cadastrar-se</h2>
            <form id="signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="signup" value="1">
                <input type="text" name="username" placeholder="Nome de usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>
</body>
</html>
