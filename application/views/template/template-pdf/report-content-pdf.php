<link href="<?= base_url('assets/plugin/') ?>css/mpdf.css" rel="stylesheet" type="text/css" />

<?php
$no = 0;
foreach ($data['content'] as $val) {
    $pembimbing = $this->M_activity->get_mentor_name($val['pembimbing']);
    $get_foto = $this->M_activity->get_foto($val['ID']);
    $kegiatan = (strlen($val['detail']) > 606) ? substr($val['detail'], 0, 606) . '...' : $val['detail'];
?>
    <div class="w-100 relative">
        <img src="<?= base_url('assets/metronic-v7/'); ?>media/solo-abadi/bg-content-report-min-cut.jpg" style="width: 100%; height:auto;" alt="">
    </div>
    <div class="w-100" style="height: 100%;">
        <div style="padding: -13% 5% 0% 5%;">
            <div style="padding: 0% 2% 0% 2%;">
                <h3 class="font-bold blue"><?= $data['name'] ?></h3>
                <table class="sobad-table">
                    <tbody>
                        <tr>
                            <td class="w-55">
                                <!-- <h5 class="grey font-light">Teknik Rekayasa Manufaktur</h5> -->
                            </td>
                            <td class="w-20">
                                <h5 class="grey font-light">Tanggal/Hari</h5>
                            </td>
                            <td class="w-25 pl-sm grey font-light" style="border: 0.1px solid #8F8F8F;"><?= $val['date'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="sobad-table pt-xs">
                    <tbody>
                        <tr>
                            <td class="w-55">
                                <h5 class="grey font-light"><?= $val['tittle'] ?></h5>
                            </td>
                            <td class="w-20">
                                <h5 class="grey font-light">Pembimbing</h5>
                            </td>
                            <td class="w-25 pl-sm grey font-light" style="border: 0.1px solid #8F8F8F;"><?= $pembimbing[0]['user_name'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <h5 class="font-light blue">Uraian Pekerjaan</h5>
                <div class="w-100" style="padding: 3% 5% 5% 5%; border:#8F8F8F 1px solid;height:20%">
                    <p class="grey font-light"><?= $kegiatan ?></p>
                </div>
                <div class="w-100 relative">
                    <h5 class="font-light blue">Foto/Dokumentasi</h5>
                    <?php foreach ($get_foto as $value) { ?>
                        <div class="w-50 float-left ">
                            <img class="p-sm" src="<?= base_url('upload-foto/'); ?><?= $value['filename'] ?>" style="width: 300px; height:150px;" alt="">
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0">
        <table class="sobad-table p-md">
            <tbody>
                <tr>
                    <td>
                        <h6 class="font-light light-grey">Laporan Magang</h6>
                    </td>
                    <td>
                        <h6 class="blue font-medium"><?= ++$no ?></h6>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>