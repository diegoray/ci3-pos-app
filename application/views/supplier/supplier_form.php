<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Supplier<small>Control Panel</small></h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Supplier</li>
		<li class="active">Add</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= ucfirst($page) ?> Supplier</h3>
            <div class="pull-right">
                <a href="<?= site_url('supplier') ?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?= site_url('supplier/process') ?>" method="POST">
                        <div class="form-group">
                            <label>Supplier Name *</label>
                            <input type="hidden" name="id" value="<?= $row->supplier_id ?>">
                            <input type="text" name="supplier_name" value="<?= $row->name ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Phone *</label>
                            <input type="number" name="phone" value="<?= $row->phone ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Address *</label>
                            <textarea name="address" class="form-control" required><?= $row->address ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control"><?= $row->description ?></textarea>
                        </div>
                        <div class="form-group pull-right">
                            <button type="submit" name="<?=$page?>" class="btn btn-success btn-flat">
                                <i class="fa fa-paper-plane"></i> Save
                            </button>
                            <button type="reset" class="btn btn-flat">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

</section>
<!-- /.content -->