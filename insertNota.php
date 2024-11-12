<?php 

session_start();

if (isset($_POST['nota'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";

    $db = new Database();

    try {
        $result = $db->dbInsert("INSERT INTO notas
                                (nota, cod_aluno, cod_turma, disciplina_id)
                                VALUES (?, ?, ?, ?)"
                                ,[
                                    Funcoes::strDecimais($_POST['nota']),
                                    $_POST['cod_aluno'],
                                    $_POST['cod_turma'],
                                    $_POST['disciplina_id'],
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Nota registrada.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 