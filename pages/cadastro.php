<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro</title>
        <link rel="stylesheet" href="../css/geral.css">
        <link rel="stylesheet" href="../css/formulario.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
    </head>
    <body>
        <?php
            require_once('./components/nav.html');
            include('conexao.php');
        ?>
        <h1>Cadastro</h1>
        <form name="cadastro" action="#" method="POST">
            <label for="nome">Nome completo:</label>
            <input type="text" name="nome" id="nome">

            <section class="campo-data">
                    <label for="data">Data de nascimento:</label>
                    <section class="input-data">
                    <input type="date" name="nasc-data" id="data">
                    <span class="material-symbols-outlined">calendar_month</span>
                </section>
            </section>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf">

            <label for="curso">Curso:</label>
            <select name="curso" id="curso">
                <?php
                    $sqlcurso = 'select distinct al_curso from estudante order by al_curso;';
                    $resulcurso = mysqli_query($con, $sqlcurso);
                    while($cursooption = mysqli_fetch_array($resulcurso)){
                        echo '<option value="'.$cursooption['al_curso'].'">'.$cursooption['al_curso'].'</option>';
                    }
                ?>
            </select>

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco">

            <label for="observacoes">Observações:</label>
            <input type="text" name="observacoes" id="observacoes">

            <button type="submit" name="enviar" id="enviar">Cadastrar</button>
        </form>        
        <script src="./js/formatarCpf.js"></script>
        <?php

            if(isset($_POST['enviar'])){
                $nome = $_POST['nome'];
                $nascimento = $_POST['nasc-data'];
                $cpf = $_POST['cpf'];
                $curso = $_POST['curso'];
                $endereco = $_POST['endereco'];

                $turma = strtoupper(substr($curso,0,2))."-A1";

                $observacoes = $_POST['observacoes'];

                if(empty($nome)||empty($nascimento)||empty($cpf)||empty($curso)||empty($endereco)){
                    echo'<script>alert("Preencha todos os campos");</script>';
                }else{
                    $sql = 'insert into estudante(al_nome,al_datanascimento,al_cpf,al_curso,al_anoescolar,al_endereco,al_turma,al_observacoes) values ("'.$nome.'","'.$nascimento.'","'.$cpf.'","'.$curso.'",1,"'.$endereco.'","'.$turma.'","'.$observacoes.'");';
                    if (mysqli_query($con,$sql)) {
                        echo '<script>alert("Usuário cadastro com sucesso");window.location.href="cadastro.php";</script>';
                    }

                }
            }
        ?>
    </body>
</html>