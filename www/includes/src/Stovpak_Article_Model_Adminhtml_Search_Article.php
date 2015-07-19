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
 * Admin search model
 *
 * @category    Stovpak
 * @package     Stovpak_Article
 * @author      Ultimate Module Creator
 */
class Stovpak_Article_Model_Adminhtml_Search_Article extends Varien_Object
{
    /**
     * Load search results
     *
     * @access public
     * @return Stovpak_Article_Model_Adminhtml_Search_Article
     * @author Ultimate Module Creator
     */
    public function load()
    {
        $arr = array();
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($arr);
            return $this;
        }
        $collection = Mage::getResourceModel('stovpak_article/article_collection')
            ->addFieldToFilter('title', array('like' => $this->getQuery().'%'))
            ->setCurPage($this->getStart())
            ->setPageSize($this->getLimit())
            ->load();
        foreach ($collection->getItems() as $article) {
            $arr[] = array(
                'id'          => 'article/1/'.$article->getId(),
                'type'        => Mage::helper('stovpak_article')->__('Article'),
                'name'        => $article->getTitle(),
                'description' => $article->getTitle(),
                'url' => Mage::helper('adminhtml')->getUrl(
                    '*/article_article/edit',
                    array('id'=>$article->getId())
                ),
            );
        }
        $this->setResults($arr);
        return $this;
    }
}
