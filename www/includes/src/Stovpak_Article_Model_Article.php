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
 * Article model
 *
 * @category    Stovpak
 * @package     Stovpak_Article
 * @author      Ultimate Module Creator
 */
class Stovpak_Article_Model_Article extends Mage_Core_Model_Abstract
{
    /**
     * Entity code.
     * Can be used as part of method name for entity processing
     */
    const ENTITY    = 'stovpak_article_article';
    const CACHE_TAG = 'stovpak_article_article';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'stovpak_article_article';

    /**
     * Parameter name in event
     *
     * @var string
     */
    protected $_eventObject = 'article';

    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('stovpak_article/article');
    }

    /**
     * before save article
     *
     * @access protected
     * @return Stovpak_Article_Model_Article
     * @author Ultimate Module Creator
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();
        $now = Mage::getSingleton('core/date')->gmtDate();
        if ($this->isObjectNew()) {
            $this->setCreatedAt($now);
        }
        $this->setUpdatedAt($now);
        return $this;
    }

    /**
     * get the url to the article details page
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getArticleUrl()
    {
        if ($this->getUrlKey()) {
            $urlKey = '';
            if ($prefix = Mage::getStoreConfig('stovpak_article/article/url_prefix')) {
                $urlKey .= $prefix.'/';
            }
            $urlKey .= $this->getUrlKey();
            if ($suffix = Mage::getStoreConfig('stovpak_article/article/url_suffix')) {
                $urlKey .= '.'.$suffix;
            }
            return Mage::getUrl('', array('_direct'=>$urlKey));
        }
        return Mage::getUrl('stovpak_article/article/view', array('id'=>$this->getId()));
    }

    /**
     * check URL key
     *
     * @access public
     * @param string $urlKey
     * @param bool $active
     * @return mixed
     * @author Ultimate Module Creator
     */
    public function checkUrlKey($urlKey, $active = true)
    {
        return $this->_getResource()->checkUrlKey($urlKey, $active);
    }

    /**
     * get the article Abstract
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getAbstract()
    {
        $abstract = $this->getData('abstract');
        $helper = Mage::helper('cms');
        $processor = $helper->getBlockTemplateProcessor();
        $html = $processor->filter($abstract);
        return $html;
    }

    /**
     * get the article Body
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getBody()
    {
        $body = $this->getData('body');
        $helper = Mage::helper('cms');
        $processor = $helper->getBlockTemplateProcessor();
        $html = $processor->filter($body);
        return $html;
    }

    /**
     * save article relation
     *
     * @access public
     * @return Stovpak_Article_Model_Article
     * @author Ultimate Module Creator
     */
    protected function _afterSave()
    {
        return parent::_afterSave();
    }

    /**
     * get default values
     *
     * @access public
     * @return array
     * @author Ultimate Module Creator
     */
    public function getDefaultValues()
    {
        $values = array();
        $values['status'] = 1;
        $values['in_rss'] = 1;
        return $values;
    }
    
}
