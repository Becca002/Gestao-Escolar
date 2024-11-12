<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$aAluno = $db->dbSelect("SELECT * FROM aluno ORDER BY nome_completo");

$aTurma = $db->dbSelect("SELECT * FROM turma ORDER BY nome_turma");

$dados = [];

$mensalidade_id = isset($_GET['mensalidade_id']) ? $_GET['mensalidade_id'] : null;

if (isset($_GET['acao']) != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM mensalidade WHERE mensalidade_id = ?",
        'first',
        [$mensalidade_id]
    );
} else if (!isset($_GET['acao'])) {
    echo "Ação não definida.";
}

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Mensalidades<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaMensalidade" class="btn btn-outline-secondary btn-sm">Voltar</a>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>Mensalidade.php" method="POST">

        <input type="hidden" name="mensalidade_id" id="mensalidade_id" value="<?= funcoes::setValue($dados, "mensalidade_id") ?>">

        <div class="row">

            <div class="col-4">
                <label for="valor" class="form-label">Valor da Mensalidade</label>
                <input type="text" class="form-control" id="valor" name="valor" required dir="rtl" value="<?= Funcoes::setValue($dados, 'valor') ?>">
            </div>

            <div class="col-4">
                <label for="data_vencimento" class="form-label">Data de vencimento</label>
                <input type="text" class="form-control" id="data_vencimento" name="data_vencimento" required value="<?= funcoes::setValue($dados, 'data_vencimento') ?>">
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
                <a href="index.php?pagina=listaMensalidade" class="btn btn-outline-secondary btn-sm">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>