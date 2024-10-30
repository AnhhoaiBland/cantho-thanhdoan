

<div style="background-color: #e63aac">


    <div class="d-flex container align-items-center text-white p-2">
        <a href="<?= base_url() ?>" class="logo" style="width: 130px">
            <img  src="<?=base_url(). "upload/media/images/". $logo ?>" alt="" />
        </a>
        <div class="tenToChu_khauhieu">
            <div class="tenToChuc fw-bold">
                <?=WEB_TITLE_UPPER ?>
            </div>
            <div class="khauHieu"><?= $slogan ?></div>
        </div>
    </div>
    <!-- slide -->
    <?= $this->renderSection('templates/slide') ?>
    <!-- end slide -->

    <div class="menubar container">
        <div class="menu_shadow">
            <div class="wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="responsive-menu"></div>
                        <div class="mainmenu" style="text-align: center;">
                            <div class="pull-left" id="logo_in_menu">
                            </div>
                            <ul id="primary-menu">
                                <li><a class="text-white fw-bold" href="<?=base_url()?>index_v2"><img style="width: 30px;" src="<?= base_url("public/icons/homeIcon.png") ?>" alt=""></a></li>

                                <!-- load danh mục ở đây -->
                                <?php
                                function generateMenu($categories, &$menuHtml, $parentUrl = "")
                                {
                                    foreach ($categories as $danhMucCha) {
                                        $maChuyenMucCha = $danhMucCha["maChuyenMuc"];
                                        $tenChuyenMucCha = $danhMucCha["tenChuyenMuc"];
                                        $urlChuenMuc = $danhMucCha["urlChuenMuc"] ?? "";
                                        $subcategories = $danhMucCha["subcategories"];

                                        $menuHtml .= "<li>";
                                        $menuHtml .=  "<a class='text-white fw-bold' href='" . base_url() . "cate_v2/{$parentUrl}{$urlChuenMuc}'>{$tenChuyenMucCha}";

                                        // Check if there are subcategories
                                        if (!empty($subcategories)) {
                                            $menuHtml .= "<i class='fa fa-angle-down'></i>";
                                        }

                                        $menuHtml .= "</a>";

                                        // Recursively generate subcategories
                                        if (!empty($subcategories)) {
                                            $menuHtml .= "<ul>";
                                            generateMenu($subcategories, $menuHtml, $parentUrl . $urlChuenMuc . "/");
                                            $menuHtml .= "</ul>";
                                        }

                                        $menuHtml .= "</li>";
                                    }
                                }
                                generateMenu($ds_category, $menuHtml);
                                echo $menuHtml;
                                ?>
                                <li><a class="text-white fw-bold" href="<?= base_url("tailieu_vanban") ?>">Văn bản</a></li>
                                <li><a class="text-white fw-bold" href="<?= base_url("gop-y") ?>">Góp ý</a></li>
                                <li><a class="text-white fw-bold" href="<?= base_url("sitemap") ?>">Sơ đồ trang</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- menu area end -->
</div>