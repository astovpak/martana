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
 * Article RSS block
 *
 * @category    Stovpak
 * @package     Stovpak_Article
 * @author      Ultimate Module Creator
 */
class Stovpak_Article_Block_Article_Rss extends Mage_Rss_Block_Abstract
{
    /**
     * Cache tag constant for feed reviews
     *
     * @var string
     */
    const CACHE_TAG = 'block_html_article_article_rss';

    /**
     * constructor
     *
     * @access protected
     * @return void
     * @author Ultimate Module Creator
     */
    protected function _construct()
    {
        $this->setCacheTags(array(self::CACHE_TAG));
        /*
         * setting cache to save the rss for 10 minutes
         */
        $this->setCacheKey('stovpak_article_article_rss');
        $this->setCacheLifetime(600);
    }

    /**
     * toHtml method
     *
     * @access protected
     * @return string
     * @author Ultimate Module Creator
     */
    protected function _toHtml()
    {
        $url    = Mage::helper('stovpak_article/article')->getArticlesUrl();
        $title  = Mage::helper('stovpak_article')->__('Articles');
        $rssObj = Mage::getModel('rss/rss');
        $data  = array(
            'title'       => $title,
            'description' => $title,
            'link'        => $url,
            'charset'     => 'UTF-8',
        );
        $rssObj->_addHeader($data);
        $collection = Mage::getModel('stovpak_article/article')->getCollection()
            ->addFieldToFilter('status', 1)
            ->addStoreFilter(Mage::app()->getStore())
            ->addFieldToFilter('in_rss', 1)
            ->setOrder('created_at');
        $collection->load();
        foreach ($collection as $item) {
            $description = '<p>';
            $description .= '<div>'.
                Mage::helper('stovpak_article')->__('Title').': 
                '.$item->getTitle().
                '</div>';
            $description .= '<div>'.
                Mage::helper('stovpak_article')->__('Abstract').': 
                '.$item->getAbstract().
                '</div>';
            $description .= '<div>'.
                Mage::helper('stovpak_article')->__('Body').': 
                '.$item->getBody().
                '</div>';
            if ($item->getImage()) {
                $description .= '<div>';
                $description .= Mage::helper('stovpak_article')->__('Image');
                $description .= '<img src="'.Mage::helper('stovpak_article/article_image')->init($item, 'image')->resize(75).'" alt="'.$this->escapeHtml($item->getTitle()).'" />';
                $description .= '</div>';
            }
            $description .= '</p>';
            $data = array(
                'title'       => $item->getTitle(),
                'link'        => $item->getArticleUrl(),
                'description' => $description
            );
            $rssObj->_addEntry($data);
        }
        return $rssObj->createRssXml();
    }
}
