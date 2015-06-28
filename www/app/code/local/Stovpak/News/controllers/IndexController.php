<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stovpak_News_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $news = Mage::getModel('stovpaknews/news')->getCollection()->setOrder('created', 'DESC');
        $viewUrl = Mage::getUrl('news/index/view');

        echo '<h1>News</h1>';
        foreach ($news as $item) {
            echo '<h2><a href="' . $viewUrl . '?id=' . $item->getId() . '">' . $item->getTitle() . '</a></h2>';
        }
    }

    public function viewAction()
    {
        $newsId = Mage::app()->getRequest()->getParam('id', 0);
        $news = Mage::getModel('stovpaknews/news')->load($newsId);

        if ($news->getId() > 0) {
            echo '<h1>' . $news->getTitle() . '</h1>';
            echo '<div class="content">' . $news->getContent() . '</div>';
        } else {
            $this->_forward('noRoute');
        }
    }
}