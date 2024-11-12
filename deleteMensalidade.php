<?php 

session_start();

if (isset($_POST['valor'])) {

    require_once "lib/Database.php";
    
    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM mensalidade
                                WHERE mensalidade_id = ?"
                                ,[
                                    $_POST['mensalidade_id']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Mensalidade excluída com sucesso.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 