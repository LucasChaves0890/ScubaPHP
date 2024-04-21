<?php $this->layout('layout') ?>
<a href="./">
    <h1>Scuba<span>PHP</span></h1>
</a>
<form action="./esqueci" method="post">
    <p>Alterar Senha</p>
    
    <?php if (isset($sucess)) : ?>
        <div class="mensagem-sucesso">
            <p><?= $sucess ?></p>
        </div>
    <?php endif; ?>


    <label for="email">E-mail</label>
    <input type="email" required name="email" value="<?= $email ?>">
    <?php if (isset($errors['email'])) : ?>
        <div class="mensagem-erro">
            <p><?= $errors['email'] ?></p>
        </div>
    <?php endif; ?>

    <input type="submit" value="Solicitar">

</form>