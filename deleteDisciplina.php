<?php 

session_start();

if (isset($_POST['disciplina'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM disciplina
                                WHERE disciplina_id = ?"
                                ,[
                                    $_POST['disciplina_id']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Disciplina excluída com sucesso.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 