<div style="position: absolute; top: 1rem; right: 1rem;">
    <!-- Toast -->
    <div class="toast" id="msg" role="alert" aria-live="assertive" aria-atomic="true"
         data-bs-delay="5000">
        <div class="toast-header">
            <i data-feather="bell"></i>
            <strong class="mr-auto">Message</strong>

            <button class="ml-2 mb-1 btn-close" type="button" data-bs-dismiss="toast"
                    aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php echo $msg; ?>
        </div>
    </div>
</div>
