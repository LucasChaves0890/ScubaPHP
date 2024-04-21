<?php $this->layout('layout', ['title' => 'Trocar Senha']); ?>
<a href="./">
    <h1>Scuba<span>PHP</span></h1>
</a>
<form action="./change-password" method="post">
    <div class="mensagem-erro">
        <?php if (isset($errors['invalid-token'])) : ?>
            <p>
                <?= $errors['invalid-token']; ?>
            </p>
        <?php endif; ?>
    </div>

    <p>Alterar Senha</p>

    <input type="hidden" name="token" value="<?= $token ?>">

    <label for="senha">Senha</label>
    <input type="password" name="password">

    <?php if (isset($errors['password'])) : ?>
        <span class="mensagem-erro">
            <?= $errors['password']; ?>
        </span>
    <?php endif; ?>

    <label for="repita-senha">Repita Senha</label>
    <input type="password" name="password-confirm">
    <?php if (isset($errors['password-confirm'])) : ?>
        <span class="mensagem-erro">
            <?= $errors['password-confirm']; ?>
        </span>
    <?php endif; ?>

    <input type="submit" value="Salvar">
</form>