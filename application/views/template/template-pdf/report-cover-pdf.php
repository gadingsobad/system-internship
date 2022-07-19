<link href="<?= base_url('assets/plugin/') ?>css/mpdf.css" rel="stylesheet" type="text/css" />

<div class="w-100">
    <img src="<?= base_url('assets/metronic-v7/'); ?>media/solo-abadi/bg-cover-report-min.png" style="width: 100%; height:auto;" alt="">
</div>
<div class="w-100 pl-xl pr-l">
    <div class="mt-md pl-xl">
        <table class="sobad-table pl-xl">
            <tbody>
                <tr>
                    <td class="w-50 align-top">
                        <h1 class="font-bold blue">Laporan</h1>
                    </td>
                    <td rowspan="2" class="w-50 text-center pl-md">
                        <barcode disableborder="1" code="<?= $data['id_user'] ?>" class="barcode pb-lg pt-sm" type="QR" size="1" />
                    </td>
                </tr>
                <tr>
                    <td class="bg-linear-light-yellow align-top">
                        <h2 class="font-bold blue">Magang.</h2>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="pt-lg">
                        <h4 class="light-blue font-light">Solo Abadi Internship Program</h4>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="w-100 relative">
    <div style="margin-top: 18%">
        <table class="sobad-table p-lg">
            <tbody>
                <tr>
                    <td class="text-left">
                        <h5 class="grey font-light"><?= $data['name'] ?></h5>
                    </td>
                    <td class="text-right">
                        <h5 class="light-grey font-light">Batch#<?= $data['batch'] ?>@<?php echo date("Y") ?></h5>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- disables it -->