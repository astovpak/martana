<?php 
/**
 * Stovpak_Article extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Stovpak
 * @package        Stovpak_Article
 * @copyright      Copyright (c) 2015
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Article helper
 *
 * @category    Stovpak
 * @package     Stovpak_Article
 * @author      Ultimate Module Creator
 */
class Stovpak_Article_Helper_Article extends Mage_Core_Helper_Abstract
{

    /**
     * get the url to the articles list page
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getArticlesUrl()
    {
        if ($listKey = Mage::getStoreConfig('stovpak_article/article/url_rewrite_list')) {
            return Mage::getUrl('', array('_direct'=>$listKey));
        }
        return Mage::getUrl('stovpak_article/article/index');
    }

    /**
     * check if breadcrumbs can be used
     *
     * @access public
     * @return bool
     * @author Ultimate Module Creator
     */
    public function getUseBreadcrumbs()
    {
        return Mage::getStoreConfigFlag('stovpak_article/article/breadcrumbs');
    }

    /**
     * check if the rss for article is enabled
     *
     * @access public
     * @return bool
     * @author Ultimate Module Creator
     */
    public function isRssEnabled()
    {
        return  Mage::getStoreConfigFlag('rss/config/active') &&
            Mage::getStoreConfigFlag('stovpak_article/article/rss');
    }

    /**
     * get the link to the article rss list
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getRssUrl()
    {
        return Mage::getUrl('stovpak_article/article/rss');
    }
}
