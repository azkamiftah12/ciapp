<div class="container">
    <div class= "col-lg-12 mb-5">
    <h2 class="text-center">
            <?= esc($title) ?>
    </h2>
    </div>


    <div class="col-lg-12">
        
        <input class="btn btn-success my-3" type="button" value="Create" onclick="location='news/create'"/>
        
        <?php if(session()->getFlashdata('successmessage')) :?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <?= session()->getFlashdata('successmessage'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php elseif (session()->getFlashdata('dangermessage')) : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <?= session()->getFlashdata('dangermessage'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php elseif (session()->getFlashdata('warningmessage')) : ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <?= session()->getFlashdata('warningmessage'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($news) && is_array($news)): ?>

            <?php
            $no = 1;
            ?>
            <table class="table table-striped table-hover table-fixed table-dark">
                <tr class="text-center">
                    <th>
                        No
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Body
                    </th>
                    <th>Preview</th>
                    <th>
                        Link
                    </th>
                </tr>

                <?php foreach ($news as $news_item): ?>
                    <tr>

                        <td>
                            <?= $no++ ?>
                        </td>
                        <td style="width: 15%;">
                            <?= esc($news_item['title']) ?>
                        </td>

                        <td class="w-50">
                            <?= esc($news_item['body']) ?>
                        </td>
                        <td>
                            <img class="rounded" src="/img/<?= esc($news_item['coverimg'])?>" alt="" width="100" height="100">
                        </td>
                        <td class="px-3">
                            <div class="row mt-2 py-3 gy-2">
                                <div class="col">
                                    <a class="btn btn-primary" href="/news/<?= esc($news_item['slug'], 'url') ?>">View</a>
                                </div>
                                <div class="col">
                                    <a class="btn btn-warning" href="/news/update/<?= esc($news_item['id'], 'url') ?>">Edit</a>
                                </div>
                                <div class="col">
                                    <a class="btn btn-danger" href="<?php echo base_url("news/delete/").$news_item["id"];?>" onclick="return confirm('Are you sure you want to delete this news?');">Delete</a>
                                </div>
                            </div>
                            
                        </td>

                    </tr>
                <?php endforeach ?>
            </table>

        <?php else: ?>

            <h3>No News</h3>

            <p>Unable to find any news for you.</p>

        <?php endif?>
    </div>
        
</div>
