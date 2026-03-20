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
        <h1>Estudantes</h1>
        <table>
        <?php
            include('conexao.php');
            $sqlexibir = "select * from estudante order by al_curso, al_nome";
            $resul = mysqli_query($con, $sqlexibir);
            $cursoAtual = '';
            while ($linha = mysqli_fetch_array($resul)) {
                if ($cursoAtual != $linha['al_curso']) {
                    echo '<tr>';
                    echo '<td colspan="9"><strong>'.$linha['al_curso'].'</strong></td>';
                    echo '</tr>';
                    echo '<tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Ano escolar</th>
                            <th>Turma</th>
                            <th>Ações</th>
                        </tr>';
                    $cursoAtual = $linha['al_curso'];
                }
                echo '<tr>';
                echo '<td>'.$linha['al_id'].'</td>';
                echo '<td>'.$linha['al_nome'].'</td>';
                echo '<td>'.$linha['al_anoescolar'].'</td>';
                echo '<td>'.$linha['al_turma'].'</td>';
                echo '<td>
                        <a href="editar.php?cod='.$linha['al_id'].'"><span class="material-symbols-outlined">edit</span></a>
                        <a href="deletar.php?id='.$linha['al_id'].'"><span class="material-symbols-outlined">delete</span></a>
                    </td>';
                echo '</tr>';
            }
        ?>
        </table>
    </body>
</html>