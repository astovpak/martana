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
 * Article front contrller
 *
 * @category    Stovpak
 * @package     Stovpak_Article
 * @author      Ultimate Module Creator
 */
class Stovpak_Article_ArticleController extends Mage_Core_Controller_Front_Action
{

    /**
      * default action
      *
      * @access public
      * @return void
      * @author Ultimate Module Creator
      */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if (Mage::helper('stovpak_article/article')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label' => Mage::helper('stovpak_article')->__('Home'),
                        'link'  => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'articles',
                    array(
                        'label' => Mage::helper('stovpak_article')->__('Articles'),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', Mage::helper('stovpak_article/article')->getArticlesUrl());
        }
        if ($headBlock) {
            $headBlock->setTitle(Mage::getStoreConfig('stovpak_article/article/meta_title'));
            $headBlock->setKeywords(Mage::getStoreConfig('stovpak_article/article/meta_keywords'));
            $headBlock->setDescription(Mage::getStoreConfig('stovpak_article/article/meta_description'));
        }
        $this->renderLayout();
    }

    /**
     * init Article
     *
     * @access protected
     * @return Stovpak_Article_Model_Article
     * @author Ultimate Module Creator
     */
    protected function _initArticle()
    {
        $articleId   = $this->getRequest()->getParam('id', 0);
        $article     = Mage::getModel('stovpak_article/article')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($articleId);
        if (!$article->getId()) {
            return false;
        } elseif (!$article->getStatus()) {
            return false;
        }
        return $article;
    }

    /**
     * view article action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function viewAction()
    {
        $article = $this->_initArticle();
        if (!$article) {
            $this->_forward('no-route');
            return;
        }
        Mage::register('current_article', $article);
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if ($root = $this->getLayout()->getBlock('root')) {
            $root->addBodyClass('article-article article-article' . $article->getId());
        }
        if (Mage::helper('stovpak_article/article')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label'    => Mage::helper('stovpak_article')->__('Home'),
                        'link'     => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'articles',
                    array(
                        'label' => Mage::helper('stovpak_article')->__('Articles'),
                        'link'  => Mage::helper('stovpak_article/article')->getArticlesUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'article',
                    array(
                        'label' => $article->getTitle(),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', $article->getArticleUrl());
        }
        if ($headBlock) {
            if ($article->getMetaTitle()) {
                $headBlock->setTitle($article->getMetaTitle());
            } else {
                $headBlock->setTitle($article->getTitle());
            }
            $headBlock->setKeywords($article->getMetaKeywords());
            $headBlock->setDescription($article->getMetaDescription());
        }
        $this->renderLayout();
    }

    /**
     * articles rss list action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function rssAction()
    {
        if (Mage::helper('stovpak_article/article')->isRssEnabled()) {
            $this->getResponse()->setHeader('Content-type', 'text/xml; charset=UTF-8');
            $this->loadLayout(false);
            $this->renderLayout();
        } else {
            $this->getResponse()->setHeader('HTTP/1.1', '404 Not Found');
            $this->getResponse()->setHeader('Status', '404 File not found');
            $this->_forward('nofeed', 'index', 'rss');
        }
    }
}
