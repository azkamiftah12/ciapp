<div class="container pb-5">
    <div class="col-lg-6 d-block mx-auto">
    <h1 class="text-center pb-5">Edit News</h1>
        
        <form class="card" action="/news/edit/<?= $news['id'];?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-body">
                <div class="row m-3">
                    <label for="title">Title</label>
                    <input type="input" name="title" value="<?= esc($news['title']) ?>">
                </div>
                <div class="row m-3">
                    <input type="hidden" name="id" value="<?= esc($news['id']) ?>">
                </div>
                <div class="row m-3">
                    <label for="body">Text</label>
                    <textarea name="body" cols="45" rows="4"><?= esc($news['body']) ?></textarea>
                </div>
                <div class="row m-3">
                    <label for="coverimg" class="form-label">Input Cover Image</label>
                    <input class="form-control" type="file" id="coverimg" name="coverimg">
                </div>
                <div class="row m-3">
                    <img class="rounded" src="/img/<?= esc($news['coverimg'])?>" alt="" width="auto" height="450">
                </div>
                <div class="row m-3 g-3">
                    <input class="btn btn-success" type="submit" name="submit" value="Edit item">
                    <input class="btn btn-warning" value="back" onclick="location='/news'">
                </div>
            </div>
        </form>
    </div>
</div>