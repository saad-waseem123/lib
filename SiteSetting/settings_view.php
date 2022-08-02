<?php $this->extend("backend/layouts/app"); ?>

<?php $this->section("header_metas"); ?>
<title>Dashboard | Administrator</title>
<?php $this->endSection(); ?>

<?php $this->section("content"); ?>
<main class="content">
    <div class="container-fluid p-0">

        <div class="mb-3 d-flex justify-content-between">
            <h1 class="h3 d-inline align-middle">Site Settings</h1>
            <a href="<?php echo site_url(route_to('common_dashboard')); ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
        </div>

        <div class="row">

            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <?php if (session()->get("success")) : ?>

                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="alert-message">
                                    <?= session()->get("success") ?>
                                </div>
                            </div>
                        <?php endif ?>

                        <?php if (session()->get("error")) : ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="alert-message">
                                    <?= session()->get("error") ?>
                                </div>
                            </div>
                        <?php endif;

                        if (isset($validation)) : ?>
                            <div class="alert alert-danger">
                                <?php echo $validation->listErrors(); ?>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="<?= base_url(route_to('backend_settings')) ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <?php foreach ($formData as $row) : ?>
                                <?php if ($row['setting_key'] == 'site_logo') : ?>
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 text-sm-end">Image Preview</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="site_old_logo" value="<?= $row['setting_value'] ?? '' ?>">
                                            <div class="border w-25 text-center">
                                                <img id="logoPreview" src="<?= ($row['setting_value']) ? base_url('/uploads/' . $row['setting_value']) : 'https://via.placeholder.com/165x65?text=Preview' ?>" class="img-fluid">
                                            </div>
                                            <span>Best size: 160px X 65px</span>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 text-sm-end">Site Logo</label>
                                        <div class="col-sm-10">
                                            <input accept="image/*" type='file' name="<?= $row['setting_key'] ?>" class="form-control" id="siteLogo" />
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 text-sm-end"><?= humanize($row['setting_key']) ?></label>
                                        <div class="col-sm-10">
                                            <input value="<?= $row['setting_value'] ?>" type="text" class="form-control" placeholder="<?= 'Enter '.humanize($row['setting_key']) ?>" name="<?= $row['setting_key'] ?>">
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <div class="mb-3 row">
                                <div class="col-sm-10 ms-sm-auto">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>
<?php $this->endSection(); ?>

<?php $this->section('footer_js_includes'); ?>
<script>
    siteLogo.onchange = evt => {
        const [file] = siteLogo.files
        if (file) {
            logoPreview.src = URL.createObjectURL(file);
        }
    }

    siteFavicon.onchange = evt => {
        const [file] = siteFavicon.files
        if (file) {
            faviconPreview.src = URL.createObjectURL(file);
        }
    }
</script>
<?php $this->endSection(); ?>