<!-- 
 <?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$aCurso = $db->dbSelect("SELECT * FROM curso ORDER BY curso");

$dados = [];
$disciplina_id = isset($_GET['disciplina_id']) ? $_GET['disciplina_id'] : null;

if (isset($_GET['acao']) && $_GET['acao'] != 'insert' && $disciplina_id !== null) {
    $dados = $db->dbSelect(
        "SELECT * FROM disciplina WHERE disciplina_id = ?",
        'first',
        [$disciplina_id]
    );
} else if (!isset($_GET['acao'])) {
    echo "Ação não definida.";
}

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Disiciplinas<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaDisciplina" class="btn btn-outline-secondary btn-sm">Voltar</a>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>curso.php" method="POST">

        <input type="hidden" name="id_disciplina" id="id_disciplina" value="<?= funcoes::setValue($dados, "disciplina_id") ?>">

        <div class="row">

            <div class="col-12">
                <label for="disciplina" class="form-label">Disciplina</label>
                <input type="text" class="form-control" id="disciplina" name="disciplina" placeholder="Nome da disciplina" required autofocus value="<?= Funcoes::setValue($dados, 'disciplina') ?>">
            </div>

            <div class="col-4 mt-3">
                <label for="carga_horaria" class="form-label">Carga Horária</label>
                <input type="text" class="form-control" id="carga_horaria" name="carga_horaria" required value="<? funcoes::setValue($dados, 'carga_horaria') ?>">
            </div>

            <div class="col-8 mt-3">
                <label for="id_curso" class="form-label">Curso</label>
                <select class="form-control" id="id_curso" name="id_curso" required>
                    <option value="" <?= Funcoes::setValue($dados, 'id_curso') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aCurso as $curso): ?>
                        <option value="<?= $curso['id_curso'] ?>" <?= Funcoes::setValue($dados, 'id_curso') == $curso['id_curso'] ? 'selected' : '' ?>><?= $curso['curso'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=listaDisciplina" class="btn btn-outline-secondary btn-sm">Voltar</a>

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
$disciplina_id = isset($_GET['disciplina_id']) ? $_GET['disciplina_id'] : null;

if (isset($_GET['acao']) != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM disciplina WHERE disciplina_id = ?",
        'first',
        [$disciplina_id]
    );
} else if (!isset($_GET['acao'])) {
    echo "Ação não definida.";
}

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Disciplinas<?= $func->subTitulo(!isset($_GET['acao'])) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaDisciplina" 
                class="btn btn-outline-secondary btn-sm">
                Voltar
            </a>
        </div>
    </div>

    <!-- <form class="g-3" action="<?= $_GET['acao'] ?>listaAluno.php" method="POST"> -->
    <!--<form class="g-3" action="<?= $_GET['acao'] ?>Aluno.php" method="POST">-->
    <form class="g-3" action="insertDisciplina.php" method="POST">

        <input type="hidden" name="disciplina_id" id="disciplina_id" value="<?= funcoes::setValue($dados, "disciplina_id") ?>">

        <div class="row">

            <div class="col-12">
                <label for="disciplina" class="form-label">Disciplina</label>
                <input type="text" class="form-control" id="disciplina" name="disciplina" placeholder="Nome da disciplina" required autofocus value="<?= Funcoes::setValue($dados, 'disciplina') ?>">
            </div>

            <div class="col-4 mt-3">
                <label for="carga_horaria" class="form-label">Carga Horária</label>
                <input type="text" class="form-control" id="carga_horaria" name="carga_horaria" required value="<?= funcoes::setValue($dados, 'carga_horaria') ?>">
            </div>

            <div class="col-8 mt-3">
                <label for="id_curso" class="form-label">Curso</label>
                <select class="form-control" id="id_curso" name="id_curso" required>
                    <option value="" <?= Funcoes::setValue($dados, 'id_curso') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aCurso as $curso): ?>
                        <option value="<?= $curso['cod_curso'] ?>" <?= Funcoes::setValue($dados, 'cod_curso') == $curso['cod_curso'] ? 'selected' : '' ?>><?= $curso['curso'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=listaDisciplina" 
                    class="btn btn-outline-secondary btn-sm">
                    Voltar
                </a>

                <?php if (isset($_GET['acao']) != 'view'): ?>
                    <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>