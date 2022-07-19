<link href="<?= base_url('assets/plugin/') ?>css/mpdf.css" rel="stylesheet" type="text/css" />
<div class="relative">
    <div class="w-100" style="padding:90px 90px 0px 90px;">
        <img style="width:180px" src="<?= base_url('assets/metronic-v7/'); ?>media/solo-abadi/logo-sobad-min.png" alt="">
        <div class="w-100" style="padding-top:100px;">
            <div class="w-50 float-left">
                <div class="w-65">
                    <table class="sobad-table">
                        <tbody>
                            <tr>
                                <td class="p-0">
                                    <h1 class="font-bold blue text-space-md">Certifi</h1>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-top">
                                    <h1 class=" font-bold blue text-space-md">cate.</h1>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-linear-light-yellow align-top pr-xl">
                                    <h4 class="text-space-lg">OF COMPLETION</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="w-50 float-left">
                <table class="sobad-table" style="margin-left:50px;">
                    <tbody>
                        <tr>
                            <td>
                                <h5 class="font-light">THIS CERTIFICATE IS PRESENTED TO</h5>
                            </td>
                        </tr>
                        <tr>
                            <td class="line-bottom pt-lg">
                                <h4 class="font-medium blue text-space-md"><?= $data['data_user']['name'] ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="pt-lg">
                                <p class="font-light">For graduated and completed their assignment in the Solo Abadi Internship Program <?= date('Y') ?>, Batch#<?= $data['batch'] ?> at PT. Solo Abadi Indonesia </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="bg-linear-light-yellow w-70" style="height:2%;margin-left:50px;padding-top:10px">
                    <p class="p-0 m-0 bg-linear-light-yellow font-light"><?= $data['data_user']['_entry_date'] ?> - <?= $data['data_user']['_resign_date'] ?></p>
                </div>
            </div>
        </div>
        <div class="w-100" style="padding-left:85px;padding-top:80px;">
            <div class="w-50 float-left">
                <div class="w-100" style="padding-right:40px;">
                    <p class="font-light" style="font-size:14px;">We found the sincere, hardworking, dedicated and
                        result oriented. The intern worked well as part of
                        the Solo Abadi Family during their tenure. We
                        takethis opportunity to thank them and wish their all
                        the best for the future.</p>
                </div>
            </div>
            <div class="w-50 float-left">
                <table class="sobad-table">
                    <tbody>
                        <tr>
                            <td class="line-bottom"></td>
                            <td></td>
                            <td class="line-bottom"></td>
                        </tr>
                        <tr>
                            <td class="pt-sm">
                                <p class="bold"> C.Lintang Larasati</p>
                            </td>
                            <td class="w-10"></td>
                            <td class="pt-sm">
                                <p class="bold">Dian Untoro</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="font-light">Internship Advisor</p>
                            </td>
                            <td class="w-10"></td>
                            <td>
                                <p class="font-light">Director</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="w-100 absolute bottom-0 text-right">
        <barcode disableborder="1" code="<?= $data['data_user']['ID'] ?>" class="barcode" type="QR" size="0.6" />
    </div>
</div>