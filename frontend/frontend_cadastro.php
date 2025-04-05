<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Importação do jQuery para facilitar manipulação do DOM e requisições AJAX -->
  <script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

  <!-- Importação do Bootstrap para estilização -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />

  <!-- Link para arquivo de estilos personalizados -->
  <link rel="stylesheet" href="http://localhost/TCC_PAPINHO/assets/css/style.css" />

  <title>Cadastro Responsável</title>
</head>

<body>
  <div class="form-container">
    <!-- Campo para o nome do responsável -->
    <label>Nome:</label>
    <div class="input-group mb-3">
      <input
        type="text"
        id="nome"
        name="nome"
        class="form-control"
        placeholder="Nome completo" />
    </div>

    <!-- Campo para o e-mail -->
    <label>Email:</label>
    <div class="mb-3">
      <div class="input-group">
        <input
          type="email"
          name="email"
          id="email"
          class="form-control"
          placeholder="Insira seu email" />
      </div>
    </div>

    <!-- Campo para a senha -->
    <label>Senha:</label>
    <div class="input-group mb-3">
      <input
        type="password"
        name="senha"
        id="senha"
        class="form-control"
        placeholder="Senha..." />
    </div>

    <!-- Campo para confirmação da senha -->
    <label>Confirmação de senha:</label>
    <div class="input-group mb-3">
      <input
        type="password"
        name="confirma_senha"
        id="confirma_senha"
        class="form-control"
        placeholder="Confirme a senha..." />
    </div>

    <!-- Campo para o nome da criança -->
    <label>Nome criança:</label>
    <div class="input-group mb-3">
      <input
        type="text"
        id="nome_crianca"
        name="nome_crianca"
        class="form-control"
        placeholder="Nome criança" />
    </div>

    <!-- Campo para a data de nascimento -->
    <label>Data de nascimento</label>
    <div class="input-group mb-3">
      <input
        type="date"
        class="form-control"
        id="nascimento"
        name="nascimento" />
    </div>

    <!-- Campo para observações sobre a criança -->
    <div class="input-group mb-3">
      <textarea
        class="form-control"
        id="observacao"
        name="observacao"
        placeholder="Descreva em poucas palavras as dificuldades da criança"></textarea>
    </div>

    <!-- Botões de ação -->
    <div class="d-flex justify-content-between">
      <button class="btn btn-secondary" onclick="history.back()">
        Voltar
      </button>
      <button class="btn btn-primary" onclick="salvaFormulario()">
        Salvar
      </button>
    </div>
  </div>

  <script>
    $(document).ready(function() {});

    function salvaFormulario() {
      // Captura dos valores do formulário
      let nome_form = document.getElementById("nome").value;
      let email_form = document.getElementById("email").value;
      let senha_form = document.getElementById("senha").value;
      let confirma_senha = document.getElementById("confirma_senha").value;
      let nome_crianca_form = document.getElementById("nome_crianca").value;
      let nascimento_form = document.getElementById("nascimento").value;
      let observacao_form = document.getElementById("observacao").value;

      // Validação dos campos obrigatórios
      if (nome_form == "") {
        alert("Preencha o Nome");
        return;
      }
      if (email_form == "") {
        alert("Preencha o Email");
        return;
      }
      if (senha_form == "") {
        alert("Preencha a Senha");
        return;
      }
      if (senha_form != confirma_senha) {
        alert("As senhas não coincidem");
        return;
      }

      // Criação do objeto para enviar ao backend
      let body_backend = {
        nome: nome_form,
        email: email_form,
        senha: senha_form,
        nome_crianca: nome_crianca_form,
        nascimento: nascimento_form,
      };

      // Envio dos dados via AJAX para o backend (PHP)
      $.post("http://localhost/TCC_PAPINHO/backend/backend_cadastro.php", body_backend)
        .then((variavel_com_retorno_da_api) => {
          console.log(variavel_com_retorno_da_api);

          if (variavel_com_retorno_da_api.status == "erro") {
            alert("Erro ao cadastrar usuario");
          } else {
            window.location.href = "http://localhost/TCC_PAPINHO/frontend/frontend_home.php";

          }
        })
        .catch(() => {
          alert("Erro ao conectar ao servidor");
        });
    }
  </script>
</body>

</html>