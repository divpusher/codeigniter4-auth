<nav class="auth-menu">
    <?= lang('Auth.loggedInWelcome', [session('userData.name')]) ?> &nbsp;|&nbsp;
    <a href="<?= site_url('logout') ?>"><?= lang('Auth.logout') ?> &rarr;</a>
</nav>