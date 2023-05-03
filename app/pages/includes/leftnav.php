<?php
// Get a single stafi
$stafi = getStafiById($_SESSION["stafiID"]);

$require_configurime = $_SESSION["require_konfigurime_style"] ?? '';
?>

<nav id="left-nav" class="navbar navbar-light bg-white sticky-top navbar-expand-xl">
    <!-- Left Navbar Header -->
    <div class="shadow-sm d-flex flex-wrap align-items-center justify-content-between">
        <div class="d-flex flex-wrap align-items-center">
            <div id="profile-img" class="mr-2">
                <?php if ($stafi['image']) { ?>
                    <img src="<?php echo APP_URL . "/public/uploads/stafi/" . $stafi['image']; ?>" alt="image" width="60px" height="60px">
                <?php } else { ?>
                    <img src="<?php echo APP_URL . "/public/uploads/no-profile.png"; ?>" alt=" image" width="60px" height="60px">
                <?php } ?>
            </div>
            <div id="profile-desc" class="mt-1 text-left align-self-start">
                <span><?= $stafi["emri"] ?></span>
                <span><?= $stafi["mbiemri"] ?></span>
                <br>
                <?php
                if ($stafi['isAdmin'] == 1) {
                    echo '<small class="mt-2 text-muted"> Ju jeni Admin </strong></small>';
                } else {
                    echo '<small class="mt-2 text-muted"> Ju jeni perdorues </strong></small>';
                }
                ?>
            </div>
        </div>
        <!-- MENU Hamburger Icon -->
        <div class="ml-auto mr-1">
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#menu-links" aria-controls="menu-links" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="sr-only">Toggle navigation</span>
            </button>
        </div>
    </div>

    <!-- Left Navbar links -->
    <div id="menu-links" class="navbar-collapse collapse">
        <ul class="navbar-nav">
            <div class="dropdown-divider"></div>
            <!-- Dashboard -->
            <li class="nav-item <?php activeButton('/'); ?>">
                <a href="<?php echo APP_URL; ?>/" class="one-link" <?= $require_configurime ?>>
                    <i class="fas fa-home fa-fw"></i>Dashboard
                </a>
            </li>
            <!-- Konsumatori -->
            <li class="nav-item <?php activeButton(['konsumatori', 'konsumatori_new', 'konsumatori_view', 'konsumatori_edit']); ?>">
                <button class="dropdown-btn" <?= $require_configurime ?>>
                    <i class="fas fa-users fa-fw"></i>Konsumatori<i class="fa fa-caret-down fa-fw"></i>
                </button>
                <div class="dropdown-container">
                    <a href="index.php?page=konsumatori" class="<?php activeLink('konsumatori'); ?>">
                        <i class="fa fa-angle-double-right fa-fw"></i>Konsumatorët</a>
                    <a href="index.php?page=konsumatori_new" class="<?php activeLink('konsumatori_new'); ?>">
                        <i class="fas fa-angle-double-right fa-fw"></i>Krijo konsumator
                    </a>
                </div>
            </li>
            <!-- Produktet -->
            <li class="nav-item <?php activeButton(['produktet', 'produktet_new', 'produktet_edit']); ?>">
                <button class="dropdown-btn" <?= $require_configurime ?>>
                    <i class="fab fa-product-hunt"></i>Produktet<i class="fa fa-caret-down fa-fw"></i>
                </button>
                <div class="dropdown-container">
                    <a href="index.php?page=produktet" class="<?php activeLink('produktet'); ?>">
                        <i class="fa fa-angle-double-right fa-fw"></i>Produktet
                    </a>
                    <a href="index.php?page=produktet_new" class="<?php activeLink('produktet_new'); ?>">
                        <i class="fa fa-angle-double-right fa-fw"></i>Krijo Produkt
                    </a>
                </div>
            </li>

            <!-- Njesit -->
            <li class="nav-item <?php activeButton(['njesit', 'njesit_new', 'njesit_edit']); ?>">
                <button class="dropdown-btn" <?= $require_configurime ?>>
                    <i class="fa-regular fa-weight-scale fa-fw"></i>njesit<i class="fa fa-caret-down fa-fw"></i>

                </button>
                <div class="dropdown-container">
                    <a href="index.php?page=njesit" class="<?php activeLink('njesit'); ?>">
                        <i class="fa fa-angle-double-right"></i>njesit
                    </a>
                    <a href="index.php?page=njesit_new" class="<?php activeLink('njesit_new'); ?>">
                        <i class="fa fa-angle-double-right fa-fw"></i>Krijo njesi
                    </a>
                </div>
            </li>
            <!-- Ofertat -->
            <li class="nav-item <?php activeButton('ofertat'); ?>">
                <a href="index.php?page=ofertat" class="one-link" <?= $require_configurime ?>>
                    <i class="fa-sharp fa-regular fa-shelves"></i>ofertat
                </a>
            </li>
            <!-- Pagesa -->
            <li class="nav-item <?php activeButton('pagesat'); ?>">
                <a href="index.php?page=pagesat" class="one-link" <?= $require_configurime ?>>
                    <i class="fas fa-inventory"></i>pagesat
                </a>
            </li>

            </li>

            <?php
            //---------------- Admin LINKS START ----------------------->
            if ($stafi['isAdmin'] == 1) {
            ?>
                <!-- Stafi -->
                <li class=" nav-item <?php activeButton(['stafi', 'stafi_new', 'stafi_edit']); ?>">
                    <button class="dropdown-btn" <?= $require_configurime ?>>
                        <i class="fas fa-people-carry fa-fw"></i>Stafi<i class="fa fa-caret-down fa-fw"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="index.php?page=stafi" class="<?php activeLink('stafi'); ?>">
                            <i class="fas fa-angle-double-right"></i>Stafi
                        </a>
                        <a href="index.php?page=stafi_new" class="<?php activeLink('stafi_new'); ?>">
                            <i class="fa fa-angle-double-right fa-fw"></i>Krijo staf
                        </a>
                    </div>
                </li>
                <!-- konfigurime -->
                <li class="nav-item <?php activeButton('konfigurime'); ?>">
                    <a href="index.php?page=konfigurime" class="one-link" <?= $require_configurime ?>>
                        <i class="fas fa-cog fa-fw"></i>Konfigurime
                    </a>
                </li>
            <?php
            } //---------------- Admin LINKS END ----------------------->
            ?>

            <!-- Historia -->
            <li class="nav-item <?php activeButton('historia'); ?>">
                <a href="index.php?page=historia" class="one-link" <?= $require_configurime ?>>
                    <i class="fas fa-history fa-fw"></i>Historia
                </a>
            </li>
            <!-- Ndihmë -->
            <li class="nav-item <?php activeButton('ndihme'); ?>">
                <a href="index.php?page=ndihme" class="one-link" <?= $require_configurime ?>>
                    <i class="fas fa-info-circle fa-fw"></i>Ndihmë
                </a>
            </li>
        </ul>
    </div> <!-- Left Navbar links END -->

</nav>

<!-- main content START (ends in sideright) -->
<div id="content">