<?php 

session_start();

if (isset($_POST['nome_turma'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM turma
                                WHERE cod_turma = ?"
                                ,[
                                    $_POST['cod_turma']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Turma excluída com sucesso.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 