<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Customer<small>Control Panel</small></h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Customer</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Data customer</h3>
            <div class="pull-right">
                <a href="<?= site_url('customer/add') ?>" class="btn btn-primary btn-flat">
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
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach($row->result() as $key => $data) { ?>
                    <tr>
                        <td><?= $no++ ?>.</td>
                        <td><?= $data->name ?></td>
                        <td><?= $data->gender ?></td>
                        <td><?= $data->phone ?></td>
                        <td><?= $data->address ?></td>
                        <td class="text-center" style="width: 200px;">
                            <a href="<?= site_url('customer/edit/'.$data->customer_id) ?>" class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil"></i> Update
							</a>
							<a href="<?= site_url('customer/delete/'.$data->customer_id) ?>" onclick="return confirm('Are you sure!')" class="btn btn-danger btn-xs">
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