<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$dados = [];
$cod_curso = isset($_GET['cod_curso']) ? $_GET['cod_curso'] : null;

if (isset($_GET['acao']) && $_GET['acao'] != 'insert' && $cod_curso !== null) {
    $dados = $db->dbSelect(
        "SELECT * FROM curso WHERE cod_curso = ?",
        'first',
        [$cod_curso]
    );
} else if (!isset($_GET['acao'])) {
    echo "Ação não definida.";
}

?>
<!--
<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Cursos<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaCurso" class="btn btn-outline-secondary btn-sm">Voltar</a>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>curso.php" method="POST">

        <input type="hidden" name="id_curso" id="id_curso" value="<?= funcoes::setValue($dados, "cod_curso") ?>">

        <div class="row">

            <div class="col-4">
                <label for="curso" class="form-label">Curso</label>
                <input type="text" class="form-control" id="curso" name="curso" placeholder="Nome do curso" required autofocus value="<?= Funcoes::setValue($dados, 'curso') ?>">
            </div>

            <div class="col-4">
                <label for="duracao_curso" class="form-label">Duração</label>
                <input type="text" class="form-control" id="duracao_curso" name="duracao_curso" required value="<? funcoes::setValue($dados, 'duracao_curso') ?>">
            </div>

            <div class="col-4">
                <label for="valor_curso" class="form-label">Preço</label>
                <input type="text" class="form-control" id="valor_curso" name="valor_curso" required dir="rtl" value="<?= Funcoes::setValue($dados, 'valor_curso') ?>">
            </div>

            <div class="col-12 mt-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" id="descricao"><?= Funcoes::setValue($dados, 'descricao') ?></textarea>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=listaCurso" class="btn btn-outline-secondary btn-sm">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>
                -->
<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new Funcoes();

$dados = [];
$cod_curso = isset($_GET['cod_curso']) ? $_GET['cod_curso'] : null;

if (isset($_GET['acao']) != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM curso WHERE cod_curso = ?",
        'first',
        [$cod_curso]
    );
} else if (!isset($_GET['acao'])) {
    echo "Ação não definida.";
}

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Alunos<?= $func->subTitulo(!isset($_GET['acao'])) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaCurso" 
                class="btn btn-outline-secondary btn-sm">
                Voltar
            </a>
        </div>
    </div>

    <!-- <form class="g-3" action="<?= $_GET['acao'] ?>listaAluno.php" method="POST"> -->
    <!--<form class="g-3" action="<?= $_GET['acao'] ?>Aluno.php" method="POST">-->
    <form class="g-3" action="insertCurso.php" method="POST">

        <input type="hidden" name="id_aluno" id="id_aluno" value="<?= funcoes::setValue($dados, "cod_curso") ?>">

        <div class="row">

            <div class="col-4">
                <label for="curso" class="form-label">Curso</label>
                <input type="text" class="form-control" id="curso" name="curso" placeholder="Nome do curso" required autofocus value="<?= Funcoes::setValue($dados, 'curso') ?>">
            </div>

            <div class="col-4">
                <label for="duracao_curso" class="form-label">Duração</label>
                <input type="text" class="form-control" id="duracao_curso" name="duracao_curso" required value="<?= funcoes::setValue($dados, 'duracao_curso') ?>">
            </div>

            <div class="col-4">
                <label for="valor_curso" class="form-label">Preço</label>
                <input type="text" class="form-control" id="valor_curso" name="valor_curso" required dir="rtl" value="<?= Funcoes::setValue($dados, 'valor_curso') ?>">
            </div>

            <div class="col-12 mt-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" id="descricao"><?= Funcoes::setValue($dados, 'descricao') ?></textarea>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=listaCurso" class="btn btn-outline-secondary btn-sm">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>