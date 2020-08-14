<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	user
	<small>Control Panel</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">User</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add User</h3>
            <div class="pull-right">
                <a href="<?= site_url('user') ?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="" method="POST">
                        <div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
                            <label>Username *</label>
                            <input type="text" name="username" class="form-control" value="<?= set_value('username') ?>" autofocus>
                            <?= form_error('username') ?>
                        </div>
                        <div class="form-group <?= form_error('fullname') ? 'has-error' : null ?>">
                            <label>Name *</label>
                            <input type="text" name="fullname" class="form-control" value="<?= set_value('fullname') ?>">
                            <?= form_error('fullname') ?>
                        </div>
                        <div class="form-group <?= form_error('password') ? 'has-error' : null ?>">
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control" value="<?= set_value('password') ?>">
                            <?= form_error('password') ?>
                        </div>
                        <div class="form-group <?= form_error('passconf') ? 'has-error' : null ?>">
                            <label>Password Confirmation *</label>
                            <input type="password" name="passconf" class="form-control" value="<?= set_value('passconf') ?>">
                            <?= form_error('passconf') ?>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control"><?= set_value('address') ?></textarea>
                        </div>
                        <div class="form-group <?= form_error('level') ? 'has-error' : null ?>">
                            <label>Level *</label>
                            <select name="level" class="form-control">
                                <option value="">- Choose -</option>
                                <option value="1" <?= set_value('level') == 1 ? "selected" : null ?> >Admin</option>
                                <option value="2" <?= set_value('level') == 2 ? "selected" : null ?> >Kasir</option>
                            </select>
                            <?= form_error('level') ?>
                        </div>
                        <div class="form-group pull-right">
                            <button type="submit" class="btn btn-success btn-flat">
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