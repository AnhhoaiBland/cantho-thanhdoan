<style>
    .comment_block hr {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #FFFFFF;
    }

    .comment_block a {
        color: #82b440;
        text-decoration: none;
    }

    .blog-comment::before,
    .blog-comment::after,
    .blog-comment-form::before,
    .blog-comment-form::after {
        content: "";
        display: table;
        clear: both;
    }

    .blog-comment ul {
        list-style-type: none;
        padding: 0;
    }

    .blog-comment img {
        opacity: 1;
        filter: Alpha(opacity=100);
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
    }

    .blog-comment img.avatar {
        position: relative;
        object-fit: contain;
        float: left;
        margin-left: 0;
        margin-top: 0;
        width: 50px;
        height: 50px;
    }

    .blog-comment .post-comments {
        border: 1px solid #eee;
        margin-bottom: 20px;
        margin-left: 85px;
        margin-right: 0px;
        padding: 10px 20px;
        position: relative;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
        background: #fff;
        color: #6b6e80;
        position: relative;
    }

    .blog-comment .meta {
        font-size: 13px;
        color: #aaaaaa;
        padding-bottom: 8px;
        margin-bottom: 10px !important;
        border-bottom: 1px solid #eee;
    }

    .blog-comment ul.comments ul {
        list-style-type: none;
        padding: 0;
        margin-left: 85px;
    }

    .blog-comment-form {
        padding-left: 15%;
        padding-right: 15%;
        padding-top: 40px;
    }

    .blog-comment h3,
    .blog-comment-form h3 {
        margin-bottom: 40px;
        font-size: 26px;
        line-height: 30px;
        font-weight: 800;
    }

    .title-comment {
        color: #033e8c;
        font-weight: bold;
        padding: 2px 0 2px 0;
        border-bottom: 2px #033e8c solid;
    }
</style>

<div class="comment_block bg-body pt-2 pe-3 ps-3 ps-3 mb-4">
    <div class="blog-comment">
        <h4 class="title-comment">Góp ý và trả lời góp ý</h4>
        <ul class="comments pt-3" style="max-height: 1200px; overflow-y: auto">

            <?php foreach ($ds_thu_gop_y as $thu_gop_y) { ?>
                <li class="clearfix">
                    <img src=<?= base_url('public/icons/User-avatar.svg.png') ?> class="avatar" alt="">
                    <div class="post-comments">
                        <p class="meta"> <?= date('d/m/Y', strtotime($thu_gop_y['ngayTao'])) ?><a href="#"> <?= $thu_gop_y['tieuDe'] ?></a> <i class="pull-right"><a href="#"></a></i></p>
                        <div style="max-height: 300px; overflow-y: auto;">
                            <?= $thu_gop_y['noiDung'] ?>
                        </div>
                    </div>

                    <ul class="comments">
                        <li class="clearfix">
                            <img src=<?= base_url('public/icons/logo.png') ?> class="avatar" alt="">
                            <div class="post-comments">
                                <p class="meta"> <?php echo WEB_TITLE; echo " ".date('d/m/Y', strtotime($thu_gop_y['thoiGianPhanHoi'])) ?><a href="#"> </a> <i class="pull-right"><a href="#"></a></i></p>
                                <div style="max-height: 300px; overflow-y: auto;">
                                    <?= $thu_gop_y['noiDungTraLoiGopY'] ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            <?php } ?>

        </ul>
    </div>
</div>