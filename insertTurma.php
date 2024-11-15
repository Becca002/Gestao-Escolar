<?php 

session_start();

if (isset($_POST['nome_turma'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbInsert("INSERT INTO turma
                                (nome_turma, ano_semestre, cod_curso, cod_professor)
                                VALUES (?, ?, ?, ?)"
                                ,[
                                    $_POST['nome_turma'],
                                    $_POST['ano_semestre'],
                                    $_POST['cod_curso'],
                                    $_POST['cod_professor'],
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Turma registrada.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 