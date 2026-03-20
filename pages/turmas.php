<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista dos estudantes</title>
        <link rel="stylesheet" href="../css/geral.css">
        <link rel="stylesheet" href="../css/tabelas.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
    </head>

    <body>
        <?php
            require_once('components/nav.html');
        ?>
        <h1>Turmas</h1>
        <table>
            <tr>
                <th>Nome da turma</th>
                <th>Curso</th>
                <th>Num de Alunos</th>
                <th>Consultar</th>
            </tr>
            <?php
                include('conexao.php');
                $sqlexibirturmas = "select distinct al_turma, al_curso from estudante order by al_turma, al_curso;";
                $resul = mysqli_query($con, $sqlexibirturmas);

                while ($linha = mysqli_fetch_array($resul)){
                $turma = $linha['al_turma'];
                $sqlNumAlunos = "select count(*) as numAlunos from estudante where al_turma='$turma'";
                $resulNumAlunos = mysqli_query($con,$sqlNumAlunos);
                $numAlunos = mysqli_fetch_array($resulNumAlunos);
                    echo '<tr><td>'.$linha['al_turma'].'</td>
                        <td>'.$linha['al_curso'].'</td>
                        <td>'.$numAlunos['numAlunos'].'</td>
                        <td><a href="turmaconsulta.php?turma='.$linha['al_turma'].'"><span class="material-symbols-outlined">search</span></a></td></tr>';
                };
            ?>
        </table>
    </body>
</html>