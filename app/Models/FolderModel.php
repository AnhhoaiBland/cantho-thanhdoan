<?php

namespace App\Models;

use CodeIgniter\Model;

class FolderModel extends BaseModel
{
    protected $table = 'folders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title','name', 'parent_id', 'publication_date', 'created_at', 'updated_at', 'deleted'];

    // Get all folders, including nested ones
    public function getFolders($parentId = null)
    {
        return $this->where('parent_id', $parentId)->where('deleted', null)->findAll(); // Only retrieve folders that are not deleted
    }

    // Soft delete function
    public function softDelete($folderId)
    {
        return $this->update($folderId, ['deleted' => date('Y-m-d H:i:s')]); // Set the deleted timestamp
    }

    // Function to get all trashed folders
    public function getTrashedFolders()
    {
        return $this->where('deleted !=', null)->findAll(); // Get all folders that are deleted
    }
    public function permanentlyDelete($id)
    {
        return $this->delete($id); // This permanently removes the record from the database
    }
}
