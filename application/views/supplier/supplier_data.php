<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Supplier<small>Control Panel</small></h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Supplier</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Data Supplier</h3>
            <div class="pull-right">
                <a href="<?= site_url('supplier/add') ?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-plus"></i> Create
                </a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach($row->result() as $key => $data) { ?>
                    <tr>
                        <td><?= $no++ ?>.</td>
                        <td><?= $data->name ?></td>
                        <td><?= $data->phone ?></td>
                        <td><?= $data->address ?></td>
                        <td><?= $data->description ?></td>
                        <td class="text-center" style="width: 200px;">
                            <a href="<?= site_url('supplier/edit/'.$data->supplier_id) ?>" class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil"></i> Update
							</a>
							<!-- <a href="<?= site_url('supplier/delete/'.$data->supplier_id) ?>" onclick="return confirm('Are you sure!')" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i> Delete
                            </a> -->
                            <a href="#modal-delete" data-toggle="modal" onclick="$('#modal-delete #form-delete').attr('action', '<?= site_url('supplier/delete/'.$data->supplier_id) ?>')" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i> Delete
							</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

</section>
<!-- /.content -->

<!-- modal delete -->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Are you sure to delete this?</h4>
            </div>
            <div class="modal-footer">
                <form id="form-delete" action="" method="POST">
                    <button class="btn btn-default" data-dismiss="modal">No</button>
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>