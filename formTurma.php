<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$aCurso = $db->dbSelect("SELECT * FROM curso ORDER BY curso");

$aCoordenador = $db->dbSelect("SELECT * FROM professor ORDER BY nome_completo");

$dados = [];
$cod_turma = isset($_GET['cod_turma']) ? $_GET['cod_turma'] : null;

if (isset($_GET['acao']) != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM turma WHERE cod_turma = ?",
        'first',
        [$cod_turma]
    );
} else if (!isset($_GET['acao'])) {
    echo "Ação não definida.";
}

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Turmas<?= $func->subTitulo(!isset($_GET['acao'])) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaTurmas" class="btn btn-outline-secondary btn-sm">Voltar</a>
        </div>
    </div>

    <form class="g-3" action="insertTurma.php" method="POST">

        <input type="hidden" name="cod_turma" id="cod_turma" value="<?= funcoes::setValue($dados, "cod_turma") ?>">

        <div class="row">

            <div class="col-8">
                <label for="nome_turma" class="form-label">Nome da Turma</label>
                <input type="text" class="form-control" id="nome_turma" name="nome_turma" required value="<?= Funcoes::setValue($dados, 'nome_turma') ?>">
            </div>

            <div class="col-4">
                <label for="ano_semestre" class="form-label">Ano/Semestre</label>
                <input type="text" class="form-control" id="ano_semestre" name="ano_semestre" required value="<?= funcoes::setValue($dados, 'ano_semestre') ?>">
            </div>

            <div class="col-6 mt-3">
                <label for="cod_curso" class="form-label">Curso</label>
                <select class="form-control" id="cod_curso" name="cod_curso" required>
                    <option value="" <?= Funcoes::setValue($dados, 'cod_curso') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aCurso as $curso): ?>
                        <option value="<?= $curso['cod_curso'] ?>" <?= Funcoes::setValue($dados, 'cod_curso') == $curso['cod_curso'] ? 'selected' : '' ?>><?= $curso['curso'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

            <div class="col-6 mt-3">
                <label for="cod_professor" class="form-label">Coordenador</label>
                <select class="form-control" id="cod_professor" name="cod_professor" required>
                    <option value="" <?= Funcoes::setValue($dados, 'cod_professor') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aCoordenador as $adm): ?>
                        <option value="<?= $adm['cod_professor'] ?>" <?= Funcoes::setValue($dados, 'cod_professor') == $adm['cod_professor'] ? 'selected' : '' ?>><?= $adm['nome_completo'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=listaTurma" class="btn btn-outline-secondary btn-sm">Voltar</a>

                <?php if (isset($_GET['acao']) != 'view'): ?>
                    <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>