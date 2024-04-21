<?php $this->layout('layout', ['title' => 'Home']);
/** @var \Model\UserModel[] $user */
?>
<?php if (isset($_SESSION['verificado'])) : ?>
    <div class="mensagem-sucesso">
        <p><?= $_SESSION['verificado'] ?></p>
        <?php unset($_SESSION['verificado']); ?>
    </div>
<?php endif; ?>
<h1>Scuba<span>PHP</span></h1>

<div class="info">
    <div class="imagemPerfil">
        <img src="/elephant.png">
    </div>
    <div class="dados">
        <div class="info-dados">
            <?php if (isset($errors['error'])) : ?>
                <span class="mensagem-erro">
                    <?= $errors['error']; ?>
                    
                </span>
            <?php endif; ?>
            <p>Nome do Usuário:<?= $user['name'] ?></p>
            <p>Email do Usuário:<?= $user['email'] ?></p>
        </div>
        <div class="delete">
            <a href="./logout">
                <img src="/exit-outline.svg">
            </a>
            <a href="./delete?email=<?= $user['email'] ?>">
                <img src="/trash-outline.svg">
            </a>
        </div>
    </div>
</div>