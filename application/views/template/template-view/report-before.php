<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Report</h5>
                <!--end::Page Title-->
            </div>
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-row-fluid ">
        <!--begin::Container-->
        <div class="container">
            <!--begin::content-->
            <div class="card h-100">
                <div class="card-body">
                    <div class="col text-center " style="padding-top:15%">
                        <h3><?= $note ?></h3>
                        <a class="btn mt-5" href="<?= site_url('Activity') ?>" role="button" style="background-color:#15499A; color:white">Selesaikan</a>
                    </div>
                </div>
            </div>
            <!--end::Card-->
            <!--end::content-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->