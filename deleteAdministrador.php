<?php 

session_start();

if (isset($_POST['nome_completo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM administrador
                                WHERE cod_adm = ?"
                                , [
                                    $POST['cod_adm']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Registro excluído com sucesso.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 