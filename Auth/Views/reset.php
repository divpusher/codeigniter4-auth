<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<h1><?= lang('Auth.resetPassword') ?></h1>

<?= view('Auth\Views\_notifications') ?>

<form method="POST" action="<?= site_url('reset-password'); ?>" accept-charset="UTF-8">
    <?= csrf_field() ?>
    <p>
        <label><?= lang('Auth.newPassword') ?></label><br />
        <input required type="password" name="password" value="" />
    </p>
    <p>
        <label><?= lang('Auth.newPasswordAgain') ?></label><br />
        <input required type="password" name="password_confirm" value="" />
    </p>
    <p>
        <input type="hidden" name="token" value="<?= $_GET['token'] ?>" />
        <button type="submit"><?= lang('Auth.resetPassword') ?></button>
    </p>
</form>

<?= $this->endSection() ?>