<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$aAluno = $db->dbSelect("SELECT * FROM aluno ORDER BY nome_completo");

$aTurma = $db->dbSelect("SELECT * FROM turma ORDER BY nome_turma");

$aDisciplina = $db->dbSelect("SELECT * FROM disciplina ORDER BY disciplina");

$dados = [];

$id_nota = isset($_GET['id_nota']) ? $_GET['id_nota'] : null;

if ($_GET['acao'] != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM notas WHERE id_nota = ?",
        'first',
        [$id_nota]
    );
} else if (!isset($_GET['acao'])) {
    echo "Ação não definida.";
}

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Notas<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaNota" class="btn btn-outline-secondary btn-sm">Voltar</a>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>Nota.php" method="POST">

        <input type="hidden" name="id_nota" id="id_nota" value="<?= funcoes::setValue($dados, "id_nota") ?>">

        <div class="row">

            <div class="col-8">
                <label for="cod_aluno" class="form-label">Aluno</label>
                <select class="form-control" id="cod_aluno" name="cod_aluno" required>
                    <option value=""  <?= Funcoes::setValue($dados, 'cod_aluno') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aAluno as $aluno): ?>
                        <option value="<?= $aluno['cod_aluno'] ?>" <?= Funcoes::setValue($dados, 'cod_aluno') == $aluno['cod_aluno'] ? 'selected' : '' ?>><?= $aluno['nome_completo'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

            <div class="col-4">
                <label for="nota" class="form-label">Nota</label>
                <input type="text" class="form-control" id="nota" name="nota" required dir="rtl" value="<?= funcoes::setValue($dados, 'nota') ?>">
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

            <div class="col-6 mt-3">
                <label for="disciplina_id" class="form-label">Disciplina</label>
                <select class="form-control" id="disciplina_id" name="disciplina_id" required>
                    <option value=""  <?= Funcoes::setValue($dados, 'disciplina_id') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aDisciplina as $disc): ?>
                        <option value="<?= $disc['disciplina_id'] ?>" <?= Funcoes::setValue($dados, 'disciplina_id') == $disc['disciplina_id'] ? 'selected' : '' ?>><?= $disc['disciplina'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=listaNota" class="btn btn-outline-secondary btn-sm">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>