<?php 

session_start();

if (isset($_POST['disciplina'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE disciplina
                                SET disciplina = ?, carga_horaria = ?, cod_curso = ?
                                WHERE disciplina_id = ?"
                                ,[
                                    $_POST['disciplina'],
                                    $_POST['carga_horaria'],
                                    $_POST['cod_curso'],
                                    $_POST['disciplina_id']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Disciplina atualizada.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 