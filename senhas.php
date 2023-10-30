<!DOCTYPE html>
<html>
<head>
    <title>Gerenciador de Senhas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        form {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 300px;
            margin: 0 auto;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Gerenciador de Senhas</h1>

    <?php
    // Função para criptografar a senha
    function encryptPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    // Função para salvar um novo usuário, senha criptografada e local em um arquivo de texto
    function saveUserPassword($username, $password, $location) {
        $file = 'passwords.txt';
        $data = "$username:" . encryptPassword($password) . ":$location" . PHP_EOL;
        file_put_contents($file, $data, FILE_APPEND);
    }

    // Verifica se o formulário de registro foi enviado
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['location'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $location = $_POST['location'];

        saveUserPassword($username, $password, $location);
        echo "Senha registrada com sucesso!";
    } else {
        // Formulário de registro
        echo '
            <form method="post" action="">
            <label for="location">De onde é essa senha:</label>
            <input type="text" name="location" id="location" required><br>
                <label for="username">Usuário:</label>
                <input type="text" name="username" id="username" required><br>
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" required><br>

                <input type="submit" value="Registrar Senha">
            </form>
        ';
    }
    ?>
</body>
</html>
