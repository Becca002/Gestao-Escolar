<?php 

session_start();

if (isset($_POST['nome_turma'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE turma
                                SET nome_turma = ?, ano_semestre = ?, cod_curso = ?, cod_professor = ?
                                WHERE cod_turma = ?"
                                ,[
                                    $_POST['nome_turma'],
                                    $_POST['ano_semestre'],
                                    $_POST['cod_curso'],
                                    $_POST['cod_professor'],
                                    $_POST['cod_turma']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Turma atualizada.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 