<!--begin::Wrapper-->
<?php 
    $data_user = $this->session->userdata(['data'][0]);
    $image = empty($data_user['name_pict']) ? 'no-profile.jpg' : $data_user['name_pict'];
?>

<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
    <!--begin::Header-->
    <div id="kt_header" class="header header-fixed">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <!--begin::Header Menu Wrapper-->
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <!--begin::Header Menu-->

                <!--end::Header Menu-->
            </div>
            <!--end::Header Menu Wrapper-->
            <!--begin::Topbar-->
            <div class="topbar">
                <!--begin::User-->
                <div class="topbar-item">
                    <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-8" id="kt_quick_user_toggle" id="kt_quick_user_toggle" style="background-color: #639AEF; color:white;">
                        <span class="text-light font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                        <span class="text-light-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?= $data_user['name'] ?></span>
                        <span class="symbol symbol-lg-35 symbol-25 symbol-light">
                            <span class="symbol-label">
                                <span class="symbol-label" style="background-image:url('https://s.soloabadi.com/system-absen/asset/img/user/<?= $image; ?>')"></span>
                            </span>
                        </span>
                    </div>
                </div>
                <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
                <!--end::User-->
            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->