<?php
    include('conexao.php');
    $id = $_GET['id'];
    if(empty($id) || !is_numeric($id)){
       echo ('<script>alert("Código inválido!");window.location="alunos.php";</script>'); 
    }else{
        $sqlaluno = 'select *from estudante where al_id='.$id.';';
        $result = mysqli_query($con, $sqlaluno);
        $aluno = mysqli_fetch_array($result);
    };
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Deletar</title>
        <link rel="stylesheet" href="../css/geral.css">
        <style>
            body, #section-principal{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                font-family: Arial, sans-serif;
                overflow-x: hidden;
            }
            body{
                width: 100vw;
                height: 100vh;
                background-color: #f5f5f5;
            }
            #section-principal{
                border: 4px solid #f00;
                padding: 30px 40px;
                box-shadow: 0 0 50px 10px rgba(255, 0, 0, 0.46);
                background-color: #fff;
                text-align: center;
                border-radius: 12px;
            }
            #section-secundaria{
                width: 100%;
                font-size: 1.2em; 
                margin: 20px 0;
            }
            #deletar-titulo{
                font-size: 2em;  
                margin-bottom: 20px;
            }
            
            .btn{
                padding: 12px 25px;
                margin: 10px;
                font-size: 1em;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                font-weight: bold;
                transition: all 0.3s ease;
            }

            .btn-sim{
                background-color: #f44336;
                color: #fff;
            }
            .btn-sim:hover{
                background-color: #d32f2f;
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(244, 67, 54, 0.4);
            }

            .btn-nao{
                background-color: #9e9e9e;
                color: #fff;
                text-decoration: none;
            }
            .btn-nao:hover{
                background-color: #757575;
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(158, 158, 158, 0.4);
            }
        </style>
    </head>
    <body>
        <section id="section-principal">
            <p id="deletar-titulo">Deseja mesmo deletar <b><?php echo $aluno['al_nome']?></b>?</p>
            <section id="section-secundaria">
                <p>Curso: <?php echo $aluno['al_curso']; ?></p>
                <p>Ano: <?php echo $aluno['al_anoescolar']; ?></p>
            </section>
            <form action="#" method="POST" style="display:flex; justify-content:center;">
                <input type="hidden" name="id" value="<?php echo $aluno['al_id']; ?>">
                <button type="submit" name="confirmar" class="btn btn-sim">Sim</button>
                <a href="alunos.php" class="btn btn-nao">Não</a>
            </form>
        </section>
        <?php
            if(isset($_POST['confirmar'])){
                $sqldel = 'delete from estudante where al_id='.$id.';';
                if(mysqli_query($con,$sqldel)){
                    echo '<script>alert("Deletado com sucesso");window.location.href="alunos.php";</script>';
                }else{
                    echo '<script>alert("Erro na tentativa de deletar");window.location.href="alunos.php";</script>';
                }
            };
        ?>
    </body>
</html>
