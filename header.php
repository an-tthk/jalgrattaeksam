<header>
    <h1>Jalgrattaeksam</h1>
    <?php if (isset($_SESSION['kasutaja'])): ?>
        <p><strong><?php echo $_SESSION['kasutaja']?></strong> on sisse logitud.</p>
        <a href="logout.php?logout=1">Logi välja</a>
    <?php endif ?>
</header>