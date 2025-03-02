<?php 

session_start();

if (isset($_POST['data_matricula'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM matricula
                                WHERE matricula_id = ?"
                                ,[
                                    $_POST['matricula_id']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Matricula excluída com sucesso.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 