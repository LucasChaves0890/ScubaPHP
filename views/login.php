<?php $this->layout('layout', ['title' => 'Login']) ?>
<h1>Scuba<span>PHP</span></h1>
<form action="/logar" method="POST">

    <?php if (isset($errors['confirm-email'])) : ?>
        <div class="mensagem-erro">
            <p><?= $errors['confirm-email'] ?></p>
        </div>
    <?php endif; ?>

    <?php if (isset($sucess['sucess'])) : ?>
        <div class="mensagem-sucesso">
            <p><?= $sucess['sucess'] ?></p>
        </div>
    <?php endif; ?>

    <label for="email">Email</label>
    <input type="text" name="email" value="<?= $email ?>">
    <?php if (isset($errors['email'])) : ?>
        <span class="mensagem-erro">
            <?= $errors['email']; ?>
        </span>
    <?php endif; ?>

    <label for="password">Senha</label>
    <input type="password" name="password">
    <?php if (isset($errors['password'])) : ?>
            <span class="mensagem-erro">
                <?= $errors['password'] ?>
            </span>
    <?php endif; ?>

    <button>Entrar</button>
    <a href="./cadastrar">Cadastrar Usuário</a>
    <a href="./esqueci-senha">Esqueci Minha Senha</a>
</form>