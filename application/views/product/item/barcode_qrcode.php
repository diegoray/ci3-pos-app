<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Item<small>Barcode Generator</small></h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Item</li>
        <li class="active">Barcode Generator</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <?php $this->view('message') ?>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Barcode Generator</h3>
            <div class="pull-right">
                <a href="<?= site_url('item') ?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php
                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '"style="width:200px">';
            ?>
            <br>
            <?= $row->barcode ?>
            <br><br>
            <a href="<?= site_url('item/barcode_print/'.$row->item_id) ?>" target="_blank" class="btn btn-default btn-sm">
                <i class="fa fa-print"></i> Print
            </a>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">QR-code Generator</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php
                $qrCode = new Endroid\QrCode\QrCode($row->barcode);
                $qrCode->writeFile('uploads/qr-code/item-'.$row->item_id.'.png');
            ?>
            <img src="<?= base_url('uploads/qr-code/item-'.$row->item_id.'.png') ?>" style="width:200px">
            <br>
            <?= $row->barcode ?>
            <br><br>
            <a href="<?= site_url('item/qrcode_print/'.$row->item_id) ?>" target="_blank" class="btn btn-default btn-sm">
                <i class="fa fa-print"></i> Print
            </a>
        </div>
        <!-- /.box-body -->
    </div>

</section>
<!-- /.content -->