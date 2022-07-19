<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper" style="background: #15499A;">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="background: #15499A;">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <?php foreach ($sidebar as $value) { ?>
                <?php if ($value['sub_menu'] == '' || $value['sub_menu'] == null) { ?>
                    <li <?= $value['condition'] == "true" ? 'class="menu-item menu-item-active"' : 'class="menu-item menu-item"' ?>aria-haspopup="true">
                        <a href="<?= base_url($value['link']) ?>" class="menu-link">
                            <span class="svg-icon menu-icon">
                                <i class="<?= $value['icon'] ?>" style="color:white"></i>
                            </span>
                            <span class="menu-text"><?= $value['title'] ?></span>
                        </a>
                    </li>
                <?php } else { ?>
                    <?php if ($value['title-group'] == '' || $value['title-group'] == null) { ?>
                    <?php } else { ?>
                        <li class="menu-section">
                            <h4 class="menu-text"><?= $value['title-group'] ?></h4>
                            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                        </li>
                    <?php } ?>
                    <li <?= $value['condition'] == "true" ? 'class="menu-item menu-item-submenu menu-item-open menu-item-here"'  : 'class="menu-item menu-item-submenu"' ?> aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i class="<?= $value['icon'] ?>"></i>
                            </span>
                            <span class="menu-text"><?= $value['title'] ?></span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <?php foreach ($value['sub_menu'] as $val) { ?>
                                    <li <?= $val['condition'] == "true" ? 'class="menu-item menu-item-active"' : 'class="menu-item"' ?> aria-haspopup="true">
                                        <a href="<?= base_url($val['link']) ?>" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text"><?= $val['title'] ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
        <!--end::Menu Nav-->
        <div style="position:absolute; bottom:0;">
            <div class="col">
                <a href="https://soloabadi.com/en/" target="_blank" class="text-white">Solo Abadi Official System<br><?php echo date("Y") ?>©</br></a>
            </div>

        </div>
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
</div>
<!--end::Aside-->