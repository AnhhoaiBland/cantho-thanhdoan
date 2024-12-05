<!-- Tags Start -->
<div class="mb-3">
    <div class="section-title mb-0">
        <h4 class="m-0 text-uppercase font-weight-bold">Menu</h4>
    </div>
    <div class="bg-white border border-top-0 p-3">
        <div class="dropdown">
            <?php if (isset($laydanhsachmenu[2])): ?>
                <?php foreach ($laydanhsachmenu[2] as $parentId => $parentMenus): ?>
                    <?php if ($parentId == 0): ?>
                        <?php foreach ($parentMenus as $menu): ?>
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                <?= $menu['title']; ?>
                            </button>
                   
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</div>
<!-- Tags End -->

