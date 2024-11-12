<?php 

session_start();

if (isset($_POST['data_matricula'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";

    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE matricula
                                SET status_matricula = ?, cod_aluno = ?, cod_turma = ?
                                WHERE matricula_id"
                                ,[
                                    $_POST['status_matricula'],
                                    $_POST['cod_aluno'],
                                    $_POST['cod_turma'],
                                    $_POST['matricula_id']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Matricula atualizada com sucesso.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
}