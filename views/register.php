<?php $this->layout('layout', ['title' => 'Cadastrar']) ?>
<a href="./?page=login">
    <h1>Scuba<span>PHP</span></h1>
</a>
<form action="/criar-usuario" method="POST">
    <p>Cadastre Um Novo Usuário</p>

    <?php if (isset($errors['error'])) : ?>
        <div class="mensagem-erro">
            <p><?= $errors['error'] ?></p>
        </div>
    <?php endif; ?>

    <?php if (isset($sucess)) : ?>
        <div class="mensagem-sucesso">
            <p><?= $sucess ?></p>
        </div>
    <?php endif; ?>
 
    <label for="name">Nome</label>
    <input type="text" name="name" value="<?= $name ?>">
    <?php if (isset($errors['name'])) : ?>
        <div class="mensagem-erro">
            <p><?= $errors['name'] ?></p>
        </div>
    <?php endif; ?>

    <label for="email">E-mail</label>
    <input type="email" name="email" value="<?= $email ?>">
    <?php if (isset($errors['email'])) : ?>
        <div class="mensagem-erro">
            <p><?= $errors['email'] ?></p>
        </div>
    <?php endif; ?>

    <label for="password">Senha</label>
    <input type="password" name="password">
    <?php if (isset($errors['password'])) : ?>
        <div class="mensagem-erro">
            <p><?= $errors['password'] ?></p>
        </div>
    <?php endif; ?>

    <label for="repita-senha">Repita Senha</label>
    <input type="password" name="password-confirm">
    <?php if (isset($errors['password-confirm'])) : ?>
        <div class="mensagem-erro">
            <p><?= $errors['password-confirm'] ?></p>
        </div>
    <?php endif; ?>

    <input type="submit" value="Salvar">
</form>
