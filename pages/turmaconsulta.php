<?php
    $turma = $_GET['turma'];
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista dos estudantes</title>
        <link rel="stylesheet" href="../css/geral.css">
        <link rel="stylesheet" href="../css/tabelas.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
        <style>
            table{
                width: 40%;
            }
        </style>
    </head>

    <body>
        <?php
            require_once('components/nav.html');
        ?>
        <h1>Turma <?php echo $turma?></h1>
        <table>
            <?php
                include('conexao.php');
                $sqlexibirturmas = 'select *from estudante where al_turma="'.$turma.'" order by al_nome;';
                $resul = mysqli_query($con, $sqlexibirturmas);

                while ($linha = mysqli_fetch_array($resul)) {
                    echo '<tr><td>'.$linha['al_nome'].'</td>
                     <td>
                        <a href="editar.php?cod='.$linha['al_id'].'&turma='.$turma.'"><span class="material-symbols-outlined">edit</span></a>
                        <a href="deletar.php?id='.$linha['al_id'].'"><span class="material-symbols-outlined">delete</span></a>
                    </td>';
                };
            ?>
        </table>
    </body>
</html>