<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href=".."><i class="fa-solid fa-arrow-left ps-1 pe-3"></i></a></li>
                <li class="nav-item"><a class="nav-link" href="?page=registreerimine">Registreerimine</a></li>
                <li class="nav-item"><a class="nav-link" href="?page=teooriaeksam">Teooriaeksam</a></li>
                <li class="nav-item"><a class="nav-link" href="?page=slaalom">Slaalom</a></li>
                <li class="nav-item"><a class="nav-link" href="?page=ringtee">Ringtee</a></li>
                <li class="nav-item"><a class="nav-link" href="?page=tanav">Tänav</a></li>
                <li class="nav-item"><a class="nav-link" href="?page=lubadeleht">Lubadeleht</a></li>
                <li class="nav-item"><a class="nav-link" href="https://github.com/an-tthk/jalgrattaeksam">GitHub kood</a></li>
            </ul>
            <div class="vr mx-2"></div>
            <span class="navbar-text">
                <?php $page_ = isset($_REQUEST['page']) ? $_REQUEST['page'] : ""; ?>
                <?php if (isset($_SESSION['kasutaja'])): ?>
                    <span class="badge text-bg-primary"><?php echo $_SESSION['kasutaja']?></span> on sisse logitud.
                    <a href="?page=logout&tagasi=<?php echo $page_; ?>">Logi välja</a>
                <?php else: ?>
                    <a href="?page=login&tagasi=<?php echo $page_; ?>">Logi sisse</a>
                <?php endif ?>
            </span>
        </div>
    </div>
</nav>