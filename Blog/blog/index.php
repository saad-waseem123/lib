<?php 
if (in_array('super_admin', session()->get('permissions') ?? array()) || in_array('postcategory_create', session()->get('permissions') ?? array())){
    $createAccess = true;
}else{
    $createAccess = false;
}
if(in_array('super_admin', session()->get('permissions') ?? array()) || in_array('postcategory_edit', session()->get('permissions') ?? array()) ){
    $editAccess = true;
}else{
    $editAccess = false;
}
if(in_array('super_admin', session()->get('permissions') ?? array()) || in_array('postcategory_delete', session()->get('permissions') ?? array()) ){
    $deleteAccess = true;
}else{
    $deleteAccess = false;
}
?>
<?= $this->extend('backend/layouts/app') ?>

<?= $this->section('header_metas') ?>
<title><?= ucwords(strToPlural($moduleName)) ?></title>
<?= $this->endsection(); ?>

<?= $this->section('content') ?>
<main class="content">
    <div class="container-fluid p-0">
        <?= $this->include('backend/components/formAlert') ?>
        <div class="row">
            <?php if ($createAccess): ?>
                <div class="col">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="<?= base_url(route_to("backend_{$moduleName}_create")) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="CategoryName">PostCategory Name</label>
                                    <input type="text" name="pcat_name" class="form-control" placeholder="Enter Category Name">
                                </div>
                                <div class="form-group">
                                    <label for="ParentCategory">Parent PostCategory</label>
                                    <select name="pcat_parent_id" class="form-control">
                                        <option value="0">No Parent PostCategory</option>
                                        <?php foreach (array_filter($postcategories, function ($row) {
                                            return $row['pcat_parent_id'] == '0';
                                        }) as $category) : ?>
                                            <option value="<?= $category['id'] ?>"><?= $category['pcat_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Postategory Image</label>
                                    <div class="text-center border p-2" id="featuredImgBtn">
                                        <img src="<?= base_url('uploads/postcategories/placeholder.png') ?>" id="featuredImg" class="img-fluid" width="150px">
                                        <p>Select Image</p>
                                    </div>
                                    <input type="file" name="pcat_img" id="featuredImageInput" class="d-none" />
                                </div>
                                <div class="form-group">
                                    <label for="CategoryDesc">PostCategory Short Description</label>
                                    <textarea name="pcat_short_desc" class="form-control" placeholder="Enter PostCategory Short Description" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="CategoryDesc">PostCategory Long Description</label>
                                    <textarea name="pcat_desc" class="form-control tinymce" placeholder="Enter PostCategory Long Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="CategoryMetaTitle">PostCategory Meta Title</label>
                                    <input type="text" name="pcat_meta_title" class="form-control" placeholder="Enter Category Meta title">
                                </div>
                                <div class="form-group">
                                    <label for="CategoryMetaDesc">PostCategory Meta Description</label>
                                    <textarea name="pcat_meta_desc" class="form-control" placeholder="Enter PostCategory Meta Description" rows="5"></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            <?php endif; ?>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= ucwords(strToPlural($moduleName)) ?> Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped" id="datatables-reponsive">
                            <thead>
                                <tr>
                                    <th scope="col" width="15%">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($postcategories as $category) : ?>
                                    <tr>
                                        <td>
                                            <img src="<?= site_url('uploads/postcategories/') ?><?= ($category['pcat_img']) ? $category['pcat_img'] : 'placeholder.png' ?>" class="img-fluid">
                                        </td>
                                        <td>
                                            <p class="mb-0"><?= ($category['pcat_parent_id'] === '0') ? '<b>' . $category['pcat_name'] . '</br>' : $category['pcat_name'] ?></p>
                                            <span>
                                                <a href="#" data-id="<?= $category['id'] ?>">View</a>
                                                <?php if($editAccess): ?> 
                                                |
                                                <a href="#" class="btn-edit" data-id="<?= $category['id'] ?>" data-bs-toggle="modal" data-bs-target="#editFormModal">Edit</a> 
                                                <?php endif; ?>
                                                <?php if($deleteAccess): ?> 
                                                |
                                                 <a href="#" class="btn-delete" data-id="<?= $category['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteFormModel">Delete</a></span>
                                                <?php endif;?>
                                        </td>
                                        <td><?= word_limiter($category['pcat_short_desc'] ?? '-', 6); ?></td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
    </div>
</main>
<?php if ($editAccess): ?>
<!-- Edit From Model -->
<div class="modal fade" id="editFormModal" tabindex="-1" aria-labelledby="editFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url(route_to('backend_postcategory_update')) ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFormModalLabel">Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <input type="hidden" name="pedit_id" id="editId">
                    <div class="form-group">
                        <label for="categoryNameEdit">PostCategory Name</label>
                        <input type="text" name="pedit_cat_name" class="form-control" id="categoryNameEdit" placeholder="Enter PostCategory Name">
                    </div>
                    <div class="form-group">
                        <label for="parentCategoryEdit">Parent PostCategory</label>
                        <select name="pedit_cat_parent_id" class="form-control" id="parentCategoryEdit">
                            <option value="0">No Parent PostCategory</option>
                            <?php foreach (array_filter($postcategories, function ($row) {
                                return $row['pcat_parent_id'] == '0';
                            }) as $category) : ?>
                                <option value="<?= $category['id'] ?>"><?= $category['pcat_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editCategoryImage">Category Image</label>
                        <div class="text-center border p-2" id="editFeaturedImgBtn">
                            <img src="<?= site_url('uploads/postcategories/') ?>placeholder.png" id="editFeaturedImg" class="img-fluid" width="150px">
                            <p>Select Image</p>
                            <input type="hidden" name="pold_cat_img" value="" id="oldFeaturedImg">
                        </div>
                        <input type="file" name="pedit_cat_img" id="editFeaturedImageInput" class="d-none" />
                    </div>
                    <div class="form-group">
                        <label for="categoryShortDescEdit">PostCategory Short Description</label>
                        <textarea name="pedit_cat_short_desc" class="form-control" id="categoryShortDescEdit" placeholder="Enter Category Short Description" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoryDescEdit">PostCategory Long Description</label>
                        <textarea name="pedit_cat_desc" class="form-control tinymce" id="categoryDescEdit" placeholder="Enter Category Long Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoryMetaTitleEdit">POstCategory Meta Title</label>
                        <input type="text" name="pedit_cat_meta_title" class="form-control" id="categoryMetaTitleEdit" placeholder="Enter Category Meta title">
                    </div>
                    <div class="form-group">
                        <label for="categoryMetaDescEdit">PostCategory Meta Description</label>
                        <textarea name="pedit_cat_meta_desc" class="form-control" id="categoryMetaDescEdit" placeholder="Enter Category Meta Description" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if ($deleteAccess): ?>
<!-- Delete Form Modal -->
<div class="modal fade" id="deleteFormModel" tabindex="-1" role="dialog" aria-labelledby="deleteFormModelTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url(route_to('backend_postcategory_delete')) ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFormModel">Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="pdelete_id" id="deleteId">
                    <h3>Do you really want to <b>deleted</b> it?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif;?>
<?= $this->endsection(); ?>


<?= $this->section('footer_js_includes') ?>

<?= $this->include('backend/components/tinymce_scripts') ?>
<?= $this->include('backend/components/datatable_scripts') ?>
<?php if (in_array('super_admin', session()->get('permissions') ?? array()) || in_array('postcategory_edit', session()->get('permissions') ?? array())): ?>
<script>
    $('.btn-edit').click(function() {
        categoryId = $(this).data('id');
        $('#editId').val(categoryId);
        // Ajax
        url = '<?= base_url(route_to('backend_ajax_postcategory_edit')) ?>';
        data = {
            id: categoryId,
        };
        $.ajax({
            dataType: "json",
            url: url,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            method: "get",
            data: data,
            success: function(res) {
                console.log(res);
                $('#categoryNameEdit').val(res.pcat_name);
                $('#parentCategoryEdit').val(res.pcat_parent_id);
                if (res.pcat_img != null) {
                    $('#oldFeaturedImg').val(res.pcat_img);
                    $('#editFeaturedImg').attr("src", "<?= site_url('uploads/postcategories/') ?>" + res.pcat_img);
                }
                $('#categoryShortDescEdit').val(res.pcat_short_desc);
                tinymce.activeEditor.setContent(res.pcat_desc);
                $('#categoryMetaTitleEdit').val(res.pcat_meta_title);
                $('#categoryMetaDescEdit').html(res.pcat_meta_desc);

                console.log('category get details done!');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });

    });

    $('.btn-delete').click(function() {
        attrId = $(this).data('id');
        $('#deleteId').val(attrId);
    });

    featuredImageInput.onchange = evt => {
        const [file] = featuredImageInput.files
        if (file) {
            featuredImg.src = URL.createObjectURL(file)
        }
    }
    // edit
    editFeaturedImageInput.onchange = evt => {
        const [file] = editFeaturedImageInput.files
        if (file) {
            editFeaturedImg.src = URL.createObjectURL(file)
        }
    }
    $(function() {
        //Upload Pic
        $("#featuredImgBtn").click(function() {
            $("input[id='featuredImageInput']").click();
        });

        // edit
        $("#editFeaturedImgBtn").click(function() {
            $("input[id='editFeaturedImageInput']").click();
        });

    });
</script>
<?php endif;?>
<?= $this->endsection(); ?>