<p>Thank you for signing up on <?= base_url() ?>!</p>

<p>Please click the following link to activate your account!</p>
<p><a href="<?= base_url('activate-account') . '?token=' . $hash ?>"><?= base_url('activate-account') . '?token=' . $hash ?></a></p>

<p>If you didn't register on this website, just ignore this email.</p>