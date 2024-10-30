<ul class="folder-list">
  <?php foreach ($folders as $folder): ?>
    <li class="folder">
      <!-- Main Folder -->
      <span class="caret folder-name">
        <i class="bi bi-folder-fill me-2"></i><?= $folder['name'] ?>
      </span>

      <!-- Check for Subfolders and Files -->
      <?php if (!empty($folder['files']) || !empty($folder['subfolders'])): ?>
        <ul class="nested">
          <!-- Display Files in the Folder -->
          <?php foreach ($folder['files'] as $file): ?>
            <li class="file">
              <span class="file-name">
                <i class="bi bi-file-earmark me-2"></i><?= $file['name'] ?>
              </span>
              <a href="<?= base_url($file['file_path']) ?>" class="btn btn-sm btn-outline-primary ms-2" download>Tải Về</a>
              <a href="<?= base_url($file['file_path']) ?>" class="btn btn-sm btn-outline-secondary ms-2" target="_blank">Xem Trước</a>
            </li>
          <?php endforeach; ?>

          <!-- Display Subfolders Recursively -->
          <?php if (!empty($folder['subfolders'])): ?>
            <?php foreach ($folder['subfolders'] as $subfolder): ?>
              <li class="folder">
                <span class="caret folder-name">
                  <i class="bi bi-folder-fill me-2"></i><?= $subfolder['name'] ?>
                </span>

                <!-- Recursive call for subfolder contents -->
                <ul class="nested">
                  <?php foreach ($subfolder['files'] as $subfile): ?>
                    <li class="file">
                      <span class="file-name">
                        <i class="bi bi-file-earmark me-2"></i><?= $subfile['name'] ?>
                      </span>
                      <a href="<?= base_url($subfile['file_path']) ?>" class="btn btn-sm btn-outline-primary ms-2" download>Tải Về</a>
                      <a href="<?= base_url($subfile['file_path']) ?>" class="btn btn-sm btn-outline-secondary ms-2" target="_blank">Xem Trước</a>
                    </li>
                  <?php endforeach; ?>

                  <!-- If subfolders exist inside this subfolder, render them as well -->
                  <?php if (!empty($subfolder['subfolders'])): ?>
                    <?php foreach ($subfolder['subfolders'] as $subSubfolder): ?>
                      <!-- Recursively include sub-subfolders -->
                      <li class="folder">
                        <span class="caret folder-name">
                          <i class="bi bi-folder-fill me-2"></i><?= $subSubfolder['name'] ?>
                        </span>
                        <ul class="nested">
                          <!-- Recursively handle deeper nested files or folders -->
                          <!-- Similar structure as above for deeper levels -->
                        </ul>
                      </li>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </ul>
              </li>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>
</ul>
