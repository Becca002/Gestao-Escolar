<?php
//listaMatricula.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT m.*, a.nome AS nome_aluno, t.nome_turma 
                        FROM matricula AS m 
                        INNER JOIN aluno AS a ON a.id_aluno = m.id_aluno 
                        INNER JOIN turma AS t ON t.id_turma = m.id_turma 
                        ORDER BY a.nome");

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Lista de Disciplinas</h3>
        </div>
    </div>
    <div class="col-2 text-end">
        <a href="index.php?pagina=formMatricula" class="btn btn-outline-secondary btn-sm" title="nova">Novo</a>
    </div>

    <?= funcoes::mensagem() ?>

    <table class="table table-striped table-hover table-bordered table-responsive-sm">
        <thead>
            <tr>Id</tr>
            <tr>Nome</tr>
            <tr>Turma</tr>
            <tr>Status</tr>
        </thead>

        <tbody>

            <?php if (count($data) > 0) : ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['matricula_id'] ?></td>
                        <td><?= $row['nome_aluno'] ?></td>
                        <td><?= $row['nome_turma'] ?></td>
                        <td><?= Funcoes::getStatusMatricula($row['status_matricula']) ?></td>
                        <td>
                            <a href="index.php?pagina=formMatricula&acao=update&id=<?= $row['matricula_id'] ?>" class="btn btn-outline-danger btn-sm" title="Alteração">Alterar</a>
                            <a href="index.php?pagina=formMatricula&acao=delete&id=<?= $row['matricula_id'] ?>" class="btn btn-outline-warning btn-sm" title="Exclusão">Excluir</a>
                            <a href="index.php?pagina=formMatricula&acao=view&id=<?= $row['matricula_id'] ?>" class="btn btn-outline-info btn-sm" title="Visualização">Visualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhum registro encontrado.</td>
                </tr>
            <?php endif; ?>             
        </tbody>
    </table>
</div>