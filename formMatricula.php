<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$aAluno = $db->dbSelect("SELECT * FROM aluno ORDER BY nome_completo");

$aTurma = $db->dbSelect("SELECT * FROM turma ORDER BY nome_turma");

$dados = [];
$matricula_id = isset($_GET['matricula_id']) ? $_GET['matricula_id'] : null;

if ($_GET['acao'] != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM matricula WHERE matricula_id = ?",
        'first',
        [$matricula_id]
    );
} else if (!isset($_GET['acao'])) {
    echo "Ação não definida.";
}

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Matriculas<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaMatricula" class="btn btn-outline-secondary btn-sm">Voltar</a>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>Matricula.php" method="POST">

        <input type="hidden" name="matricula_id" id="matricula_id" value="<?= funcoes::setValue($dados, "matricula_id") ?>">

        <div class="row">
        <!--
            <div class="col-4">
                <label for="data_matricula" class="form-label">Data da Matricula</label>
                <input type="text" class="form-control" id="data_matricula" name="data_matricula" placeholder="Data da matricula" required autofocus value="<?= Funcoes::setValue($dados, 'data_matricula') ?>">
            </div>
-->
            <div class="col-8">
                <label for="status_matricula" class="form-label">Status Matricula</label>
                <select class="form-control" id="status_matricula" name="status_matricula" required>
                        <option value=""  <?= Funcoes::setValue($dados, 'status_matricula') == ""  ? 'selected' : '' ?>>...</option>
                        <option value="1" <?= Funcoes::setValue($dados, 'status_matricula') == "1" ? 'selected' : '' ?>>Ativo</option>
                        <option value="2" <?= Funcoes::setValue($dados, 'status_matricula') == "2" ? 'selected' : '' ?>>Inativo</option>
                        <option value="3" <?= Funcoes::setValue($dados, 'status_matricula') == "3" ? 'selected' : '' ?>>Trancado</option>
                        <option value="4" <?= Funcoes::setValue($dados, 'status_matricula') == "4" ? 'selected' : '' ?>>Cancelado</option>
                        <option value="5" <?= Funcoes::setValue($dados, 'status_matricula') == "5" ? 'selected' : '' ?>>Agurdando Pagamento</option>
                        <option value="6" <?= Funcoes::setValue($dados, 'status_matricula') == "6" ? 'selected' : '' ?>>Pendente de Documentação</option>
                        <option value="7" <?= Funcoes::setValue($dados, 'status_matricula') == "7" ? 'selected' : '' ?>>Egresso</option>
                </select>
            </div>

            <div class="col-6 mt-3">
                <label for="cod_aluno" class="form-label">Aluno</label>
                <select class="form-control" id="cod_aluno" name="cod_aluno" required>
                    <option value=""  <?= Funcoes::setValue($dados, 'cod_aluno') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aAluno as $aluno): ?>
                        <option value="<?= $aluno['cod_aluno'] ?>" <?= Funcoes::setValue($dados, 'cod_aluno') == $aluno['cod_aluno'] ? 'selected' : '' ?>><?= $aluno['nome_completo'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

            <div class="col-6 mt-3">
                <label for="cod_turma" class="form-label">Turma</label>
                <select class="form-control" id="cod_turma" name="cod_turma" required>
                    <option value=""  <?= Funcoes::setValue($dados, 'cod_turma') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aTurma as $turma): ?>
                        <option value="<?= $turma['cod_turma'] ?>" <?= Funcoes::setValue($dados, 'cod_turma') == $turma['cod_turma'] ? 'selected' : '' ?>><?= $turma['nome_turma'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=listaMatricula" class="btn btn-outline-secondary btn-sm">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>