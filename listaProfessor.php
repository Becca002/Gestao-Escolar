<?php
//listaProfessor.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM professor");

?>

<?php
//listaAluno.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM professor ORDER BY nome_completo");

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Lista de Professores</h3>
        </div>
    </div>
    <div class="col-2 text-end">
        <a href="#" class="btn btn-outline-primary btn-sm" title="nova">Novo</a>
    </div>

    <?= funcoes::mensagem() ?>

    <table class="table table-striped table-hover table-bordered table-responsive-sm">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
            </tr>
        </thead>

        <tbody>

            <?php if (count($data) > 0) : ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['cod_professor'] ?></td>
                        <td><?= $row['nome_completo'] ?></td>
                        <td><?= $row['telefone'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td>
                            <a href="index.php?pagina=formProfessor&acao=update&id=<?= $row['cod_professor'] ?>" class="btn btn-outline-primary btn-sm" title="Alteração">Alterar</a>
                            <a href="index.php?pagina=formProfessor&acao=delete&id=<?= $row['cod_professor'] ?>" class="btn btn-outline-primary btn-sm" title="Exclusão">Excluir</a>
                            <a href="index.php?pagina=formProfessor&acao=view&id=<?= $row['cod_professor'] ?>" class="btn btn-outline-primary btn-sm" title="Visualização">Visualizar</a>
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