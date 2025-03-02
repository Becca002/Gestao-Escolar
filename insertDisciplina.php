<?php 

session_start();

if (isset($_POST['disciplina'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbInsert("INSERT INTO disciplina
                                (disciplina, carga_horaria, cod_curso)
                                VALUES (?, ?, ?)"
                                ,[
                                    $_POST['disciplina'],
                                    $_POST['carga_horaria'],
                                    $_POST['cod_curso'],
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Disciplina registrada.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 