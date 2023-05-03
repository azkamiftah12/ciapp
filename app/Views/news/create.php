<div class="container pb-5">
    <div class="col-lg-6 d-block mx-auto">
        <h2 class="text-center pb-5"><?= esc($title) ?></h2>

        <?= session()->getFlashdata('error') ?>
        <?= validation_list_errors() ?>
        <form class="card g-3" action="/news/create" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-body">
                <div class="row m-3">
                    <label for="title">Title</label>
                    <input type="input" name="title" value="<?= set_value('title') ?>">
                </div>
                <div class="row m-3">
                    <label for="body">Text</label>
                    <textarea name="body" cols="45" rows="4"><?= set_value('body') ?></textarea>
                </div>
                <div class="row m-3">
                    <label for="coverimg" class="form-label">Input Cover Image</label>
                    <input class="form-control" type="file" id="coverimg" name="coverimg">
                </div>
                <div class="row m-3 g-3">
                    <input class="btn btn-success" type="submit" name="submit" value="Create news item">
                    <input class="btn btn-warning" value="back" onclick="location='/news'">
                </div>
            </div>
            
        </form>
    </div>
    
</div>

