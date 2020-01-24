<p>Dear member of <?= base_url() ?>,</p>

<p>please click the following link to confirm your new e-mail address!</p>
<p><a href="<?= base_url('confirm-email') . '?token=' . $hash ?>"><?= base_url('confirm-email') . '?token=' . $hash ?></a></p>

<p>If you didn't request this, just ignore this email.</p>