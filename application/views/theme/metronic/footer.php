<!--begin::Footer-->
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2"><?php echo date("Y"); ?>©</span>
            <a href="#" target="_blank" class="text-dark-75 text-hover-primary">Solo Abadi Group</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Nav-->
        <div class="nav nav-dark">

        </div>
        <!--end::Nav-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Main-->
<?php if ($data_user_detail['status'] == 7) {
    $division = "Program Internship";
} else {
    $division = "Internship Mentor";
} ?>
<!-- begin::User Panel-->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">User Profile</h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label" style="background-image:url('https://s.soloabadi.com/system-absen/asset/img/user/<?= $image['msg'][0]['notes_pict']; ?>')"></div>
                <a href="<?= base_url('auth/logout'); ?>" class="btn btn-sm  font-weight-bolder py-2 px-5 mt-2 ml-4" style="background: #15499A; color:white;">Keluar</a>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary "><?= ($data_user['name']) ?></a>
                <div class="text-muted mt-0"></div>
                <h6 class="font-weight-bold  mt-7" style="color:  #639AEF;"><?= $division ?></h6>
                <p class="text-md-left mr-10"><?= $data_user_detail["phone_no"] ?></p>
                <p class="text-md-left  " style="margin-top: -15px;"><?= $data_user_detail["_address"] ?></p>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->
    </div>
    <!--end::Content-->
</div>
<!-- end::User Panel-->

<script>
    var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
</script>
<!--begin::Global Config(global config for global JS scripts)-->

<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="<?= base_url('assets/metronic-v7/') ?>plugins/global/plugins.bundle.js"></script>
<script src="<?= base_url('assets/metronic-v7/') ?>plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="<?= base_url('assets/metronic-v7/') ?>js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<script src="<?= base_url('assets/metronic-v7/') ?>plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="<?= base_url('assets/metronic-v7/') ?>js/pages/widgets.js"></script>
<!--end::Page Scripts-->

<!-- Form Repeater -->
<script src="<?= base_url('assets/metronic-v7/') ?>js/pages/crud/forms/widgets/form-repeater.js"></script>

<!-- Drop Zone Js -->
<script src="<?= base_url('assets') ?>/js/dropzone-main/src/dropzone.js"></script>

<!-- Bootstrap-Notify -->
<script src="<?= base_url('assets/metronic-v7/') ?>js/pages/features/miscellaneous/bootstrap-notify.min.js"></script>

<?php dropzone_setting() ?>
</body>
<!--end::Body-->

</html>