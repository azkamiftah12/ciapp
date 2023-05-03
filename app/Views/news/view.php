<div class="container">
    <div class="row">
        <!-- <div class="col-lg-12 pb-5">
            <h2 class="text-center">News Page</h2>
        </div> -->
        <div class="col-lg-12 p-5 mb-5 ">
            <div class="row mb-3">
                <h1 class="text-center"><?= esc($news['title']) ?></h1>
            </div>
            <div class="row px-5 offset-1 mb-5">
                <p><?= esc($news['body']) ?></p>
            </div>
            <div class="row-lg-8">
                <img class="mx-auto d-block rounded" src="/img/<?= esc($news['coverimg'])?>" alt="" width="auto" height="450">
            </div>
        
        </div>
    </div>

    <div class="col">
    <div class="row p-2 py-4" style="background-color: #292b2c;">
        <h1>Suggested News</h1>
    </div>
    <div class="row p-5 border" style="background-color: whitesmoke;">
        <?php foreach ($newssuggest as $news_item): ?>
        <div class="card mx-2 my-3 pt-3" style="width: 18rem;">
            <img src="/img/<?= esc($news_item['coverimg'])?>" class="card-img-top rounded" alt="..." width="auto" height="150">
            <div class="card-body">
                <h5 class="card-title"><?= esc($news_item['title']) ?></h5>
                <p class="card-text"><?= esc($news_item['body'])?></p>
                <a href="/news/<?= esc($news_item['slug'], 'url') ?>" class="btn btn-primary">View News</a>
            </div>
        </div>
                <?php endforeach ?>
    </div>
    </div>

    

</div>