<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 */

class Stovpak_CustomBlock_Block_ChildCategories extends Mage_Core_Block_Template{
   private $_childCategories;
   
   public function getChildCategories(){
       $categoryId = (int) $this->getRequest()->getParam('id', false);
        if (!$categoryId) {
            return false;
        }
        $cat = Mage::getModel('catalog/category')->load($categoryId);
        $subcats = $cat->getChildren();
        
        foreach(explode(',',$subcats) as $subCatid)
        {
          $_category = Mage::getModel('catalog/category')->load($subCatid);
          if($_category->getIsActive())
          {
           
           $_childCategories[]= $_category;
           
          }
        }
        return $_childCategories;
   }
}