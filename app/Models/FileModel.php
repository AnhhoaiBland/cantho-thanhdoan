<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends BaseModel
{
    protected $table = 'files';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'folder_id', 'file_type', 'file_path', 'created_at', 'updated_at', 'deleted'];

    // Optionally add a function to retrieve files for a folder
    public function getFilesByFolder($folderId)
    {
        return $this->where('folder_id', $folderId)->where('deleted', null)->findAll(); // Only retrieve files that are not deleted
    }

    // Soft delete function
    public function softDelete($fileId)
    {
        return $this->update($fileId, ['deleted' => date('Y-m-d H:i:s')]); // Set the deleted timestamp
    }

    // Function to get all trashed files
    public function getTrashedFiles()
    {
        return $this->where('deleted !=', null)->findAll(); // Get all files that are deleted
    }
    public function permanentlyDelete($id)
    {
        return $this->delete($id); // This permanently removes the record from the database
    }
}
