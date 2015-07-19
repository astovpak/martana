<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stovpak_News_Block_News extends Mage_Core_Block_Template
{

    public function getNewsCollection()
    {
        $newsCollection = Mage::getModel('stovpaknews/news')->getCollection();
        $newsCollection->setOrder('created', 'DESC');
        return $newsCollection;
    }

}