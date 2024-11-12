<?php 

session_start();

if (isset($_POST['nota'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM notas
                                WHERE id_nota = ?"
                                ,[
                                    $_POST['id_nota']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Nota excluída com sucesso.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 