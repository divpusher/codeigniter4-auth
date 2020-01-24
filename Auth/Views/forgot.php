<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<h1><?= lang('Auth.forgottenPassword') ?></h1>

<?= view('Auth\Views\_notifications') ?>

<form method="POST" action="<?= site_url('forgot-password'); ?>" accept-charset="UTF-8"
	onsubmit="submitButton.disabled = true; return true;">
	<?= csrf_field() ?>
    <p>
        <label><?= lang('Auth.typeEmail') ?></label><br />
        <input required type="email" name="email" value="<?= old('email') ?>" />
    </p>
    <p>
        <button name="submitButton" type="submit"><?= lang('Auth.setNewPassword') ?></button>
    </p>
</form>

<?= $this->endSection() ?>