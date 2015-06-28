<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Stovpak_News_Model_Resource_News extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('stovpaknews/table_news', 'news_id');
    }

}
