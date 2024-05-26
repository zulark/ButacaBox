<?php
session_start();

include ('../../api/db_connection.php');

if (isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['nome'])) {

    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $senha = $conn->real_escape_string($_POST['senha']);
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
    

    if (empty($nome) || empty($email) || empty($senhaCriptografada)) {
        $errorMessage = "Preencha todos os campos.";
    } else {

        $check_email_query = "SELECT * FROM usuarios WHERE email = '$email'";
        $check_email_result = $conn->query($check_email_query);

        if ($check_email_result->num_rows > 0) {
            $errorMessage = "Já existe um usuário registrado com este e-mail.";
        } else {
            $insert_query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senhaCriptografada')";
            if ($conn->query($insert_query) === TRUE) {
                $link_address = "http://127.0.0.1/ButacaBox/ButacaBox/src/pages/login-usuario/login.php";
                $successMessage = "Usuário cadastrado com sucesso. Você será redirecionado em 5 segundos, ou se preferir, clique <a href='".$link_address."'>AQUI</a>";
                header( "refresh:5; url=login.php" ); 
            } else {
                $errorMessage = "Erro ao cadastrar o usuário: " . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>

<body>
    <style>
        body {
            background-image: url("https://www.shutterstock.com/image-photo/movie-theater-entrance-interior-blur-600nw-1819363976.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .login-wrap {
            border-radius: 10px;
        }
    </style>
    <div class="container-lg">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-8 col-lg-6">
                <div class="login-wrap p-5 p-md-5 text-bg-dark">
                    <div class="d-flex justify-content-center mb-4 navbar-brand-logo ">
                        <img src="https://cdn-icons-png.flaticon.com/512/2598/2598702.png" alt="" class="img-fluid">
                    </div>
                    <form action="" method="POST" class="signin-form">
                        <?php if (isset($errorMessage)): ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <?php echo $errorMessage; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($successMessage)): ?>
                            <div class="alert alert-success text-center" role="alert">
                                <?php echo $successMessage; ?>
                            </div>
                        <?php endif; ?>
                        <div class="form-group mb-3">
                            <label class="label" for="nome">Nome</label>
                            <input type="text" class="form-control" placeholder="Nome" name="nome">
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="senha">Senha</label>
                            <input type="password" class="form-control" placeholder="Senha" name="senha">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-block submit w-100"
                                style="background-color: #fd8f32;">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <script>
        function createErrorAlert(message) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'alert alert-danger';
            errorDiv.setAttribute('role', 'alert');
            errorDiv.textContent = message;
            errorDiv.style.position = 'fixed';
            errorDiv.style.top = '0';
            errorDiv.style.left = '0';
            errorDiv.style.width = '100%';
            errorDiv.style.zIndex = '9999';
            document.body.prepend(errorDiv);

            setTimeout(() => {
                document.body.removeChild(errorDiv);
            }, 3000);
        }
    </script>
</body>

</html>