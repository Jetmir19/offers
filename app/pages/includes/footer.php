</div> <!-- main #content END (starts in leftnav) -->
</div> <!-- Wrapper END (starts in topnav) -->

<!-- Show only if the page is not iframe -->
<?php if (!$isIframe) : ?>
    <footer class="main-footer p-1 text-center bg-dark text-white">
        <span class="text-muted mx-auto">&copy; Offers - version <?php echo APP_VERSION; ?></span>
    </footer>
<?php endif; ?>

<script src="<?php echo APP_URL; ?>/public/js/jquery-3.7.0.min.js"></script>
<script src="<?php echo APP_URL; ?>/public/js/popper.min.js"></script>
<script src="<?php echo APP_URL; ?>/public/js/bootstrap.min.js"></script>
<script src="<?php echo APP_URL; ?>/app/scripts/main.js"></script>
<script src="<?php echo APP_URL; ?>/app/scripts/modals.js"></script>

</body>

</html>