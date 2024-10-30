<header class="container-fluid nav_top" style="color: #11286e">
    <div class="container-fluid d-flex align-items-center justify-content-end p-3 position-relative" style="height: 40px">
        <marquee style="
            font-size: 15px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
          " class="element-to-hide-960 text-white position-absolute">TRANG THÔNG TIN ĐIỆN TỬ TRUNG TÂM CÔNG NGHỆ THÔNG TIN VÀ TRUYỀN THÔNG THÀNH PHỐ CẦN THƠ </marquee>
        <ul class="d-flex list-unstyled mt-3 me-3">

            <form class="d-flex me-2">
                <input class="form-control me-2" type="search" style="height: 30px;" placeholder="Từ khóa tìm kiếm và" aria-label="Search">
            </form>

            <li>
                <a class="text-decoration-none text-nowrap fw-bold text-white" href="#">Liên hệ</a>
            </li>
            <span class="ps-1 pe-1" style="color: white">|</span>
            <li class="d-flex position-relative">
                <span class="cursor-pointer text-nowrap fw-bold text-white" id="chonNgonNgu">
                    <span><img id="rootNgonNgu" style="width: 25px" src="/icons/vietnam.png" alt="" /></span>
                </span>
                <ul class="list-unstyled position-absolute end-0" id="optNgonNgu">
                    <li id="chonTiengViet">
                        <a class="text-decoration-none text-black text-nowrap" href="#"><img style="width: 30px" src="/icons/vietnam.png" alt="" /></a>
                    </li>
                    <li id="chonTiengAnh">
                        <a class="text-decoration-none text-black text-nowrap" href="#"><img style="width: 30px" src="/icons/united-kingdom.png" alt="" /></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</header>

<div style="background-color: #033e8c" class="pt-2 pb-2">

    <div class="">
        
        <!-- slide -->
      
        <!-- end slide -->

        <div class="container_navBar">
            <nav class="navbar navbar-expand-lg navbar-dark shadow">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mt-2 d-flex  align-items-center mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active text-white fw-bold" aria-current="page" href="<?= base_url()?>"><i class="gg-home"></i></a>
                            </li>

                            <?php
                            foreach ($ds_category as $category) : ?>

                                <li class="nav-item">
                                    <a class="nav-link text-white fw-bold" href="/cate/<?= $category['urlChuenMuc'] ?>"><?= $category['tenChuyenMuc'] ?></a>
                                </li>

                            <?php endforeach ?>



                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item " href="#">Something else here</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link disabled text-white fw-bold" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white fw-bold" href="#">Sơ đồ trang</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
        </div>

    </div>
</div>