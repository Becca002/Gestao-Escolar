<?php 

session_start();

if (isset($_POST['valor'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";
    
    $db = new Database();

    try {
        $result = $db->dbInsert("INSERT INTO mensalidade
                                (valor, data_vencimento, data_pagamento, status_pagamento, cod_aluno, cod_turma)
                                VALUES (?, ?, ?, ?, ?, ?)"
                                ,[
                                    Funcoes::strDecimais($_POST['valor']),
                                    Funcoes::converterDate($_POST['data_vencimento']),
                                    Funcoes::converterDate($_POST['data_pagamento']),
                                    $_POST['status_pagamento'],
                                    $_POST['cod_aluno'],
                                    $_POST['cod_turma']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Mensalidade registrada.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 