<?php
    include('conexao.php');
    $cod = $_GET["cod"];
    if(empty($cod) || !is_numeric($cod)){
        echo ('<script>alert("Código inválido!");window.location="alunos.php";</script>');
    }else{
        $sql = 'select *from estudante where al_id='.$cod;
        $resul = mysqli_query($con, $sql);
        $dados = mysqli_fetch_array($resul);
    }
?>
<!DOCTYPE html>
    <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Sistema do Estudante</title>
            <link rel="stylesheet" href="../css/geral.css">
            <link rel="stylesheet" href="../css/formulario.css">
            <link rel="stylesheet"
                href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
            <style>

            </style>
        </head>
        <body>
            <?php
                require_once('components/nav.html');
            ?>
            <section>
                <h1>Editar Aluno: <?php echo $dados['al_nome']; ?></h1>
                <form name="confirme" action="#" method="POST">
                    <?php 
                        if(!empty($_GET["turma"])){
                            $turma = $_GET["turma"];
                            echo '<a id="voltar-turma" href="turmaconsulta.php?turma='.$turma.'">
                            <span class="material-symbols-outlined">keyboard_return</span>
                            <span>Voltar pra consulta de turma</span>
                            </a>';
                        }
                    ?>
                    <label for="id">ID:</label>
                    <input type="number" name="id" id="id" value="<?php echo $dados['al_id']; ?>" readonly>
                    <fieldset>
                        <section>
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" value="<?php echo $dados['al_nome']; ?>">
                        </section>
                    </fieldset>
                    <fieldset>
                       <section class="campo-data">
                            <label for="data">Data de nascimento:</label>
                            <section class="input-data">
                                <input type="date" name="data" id="data" value="<?php echo $dados['al_datanascimento']; ?>">
                                <span class="material-symbols-outlined">calendar_month</span>
                            </section>
                        </section>

                        <section>
                            <label for="cpf">CPF:</label>
                            <input type="text" name="cpf" id="cpf" value="<?php echo $dados['al_cpf']; ?>">
                        </section>
                    </fieldset>
                    <fieldset>
                        <section>
                            <label for="curso">Curso:</label>
                            <select name="curso" id="curso">
                                <?php
                                    $sqlcurso = 'select distinct al_curso from estudante order by al_curso;';
                                    $resulcurso = mysqli_query($con, $sqlcurso);
                                    while($cursooption = mysqli_fetch_array($resulcurso)){
                                        $selecionado = ($cursooption['al_curso'] == $dados['al_curso'])?'selected' : '';
                                        echo '<option value="'.$cursooption['al_curso'].'" '.$selecionado.'>'.$cursooption['al_curso'].'</option>';
                                    }
                                ?>
                            </select>
                        </section>
                        <section>
                            <label for="ano_escolar">Ano Escolar:</label>
                            <input type="number" name="ano_escolar" id="ano_escolar" value="<?php echo $dados['al_anoescolar'];?>">
                        </section>
                        <section>
                            <label for="turma">Turma:</label>
                            <input type="text" name="turma" id="turma" value="<?php echo $dados['al_turma']; ?>">
                        </section>
                    </fieldset>
                    <fieldset>
                        <section style="flex:3">
                            <label for="endereco">Endereço:</label>
                            <input type="text" name="endereco" id="endereco" value="<?php echo $dados['al_endereco']; ?>">
                        </section>
                    </fieldset>
                    <label for="observacoes">Observações:</label>
                    <textarea name="observacoes" id="observacoes"><?php echo $dados['al_observacoes']; ?></textarea>
                    <button type="submit" name="confirmar">Salvar Alterações</button>
                </form>
                <script src="./js/formatarCpf.js"></script>
            </section>
            <?php
                if (isset($_POST['confirmar'])) {
                    $id = $_POST['id'];
                    $nome = $_POST['nome'];
                    $nasc = $_POST['data'];
                    $cpf = $_POST['cpf'];
                    $curso = $_POST['curso'];
                    $ano_esc = $_POST['ano_escolar'];
                    $endereco = $_POST['endereco'];
                    $turma = $_POST['turma'];
                    $observacoes = $_POST['observacoes'];
                    $sqlalt = "update estudante set
                        al_nome='$nome', 
                        al_datanascimento='$nasc', 
                        al_cpf='$cpf', 
                        al_curso='$curso', 
                        al_anoescolar='$ano_esc', 
                        al_endereco='$endereco', 
                        al_turma='$turma', 
                        al_observacoes='$observacoes' 
                        WHERE al_id = $id";
                    $alterar = mysqli_query($con, $sqlalt);
                    if ($alterar) {
                        echo ('<script>window.alert("Alterado com sucesso!"); window.location="editar.php?cod='.$cod.'";</script>');
                    } else {
                        echo ('<script>window.alert("Falha ao alterar"); window.location="editar.php?cod='.$cod.'";</script>');
                    }
                }
                ?>
        </body>
    </html>