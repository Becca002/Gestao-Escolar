<?php 

session_start();

if (isset($_POST['curso'])) {

    require_once "lib/Database.php";
    
    $db = new Database();

    try {
        $result = $db->dbInsert("DELETE FROM curso
                                WHERE cod_curso = ?"
                                ,[
                                    $_POST['cod_curso']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Curso excluído com sucesso.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 