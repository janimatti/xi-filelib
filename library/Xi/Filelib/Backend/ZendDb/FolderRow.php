<?php

namespace Xi\Filelib\Backend\ZendDb;

/**
 * Folder row
 * 
 * @author pekkis
 * @package Xi_Filelib
 *
 */
class FolderRow extends \Zend_Db_Table_Row_Abstract
{

    public function findParent()
    {
        if($this->parent_id) {
            return $this->findParentRow('\Xi\Filelib\Backend\ZendDb\FolderTable');
        }
        return false;
    }

}
?>