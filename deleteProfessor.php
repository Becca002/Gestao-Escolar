<?php 

session_start();

if (isset($_POST['nome_completo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM professor
                                WHERE cod_professor = ?"
                                ,[
                                    $_POST['cod_professor']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Professor excluído com sucesso.";
        }

    } catch (\Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 

return header("Location: index.php?pagina=listaProfessor");