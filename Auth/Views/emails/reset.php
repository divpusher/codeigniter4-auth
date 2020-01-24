<p>A password update was requested on <?= base_url() ?>!</p>

<p>Please click the following link to change your password!</p>
<p><a href="<?= base_url('reset-password') . '?token=' . $hash ?>"><?= base_url('reset-password') . '?token=' . $hash ?></a></p>

<p>If you didn't request this change, just ignore this email.</p>