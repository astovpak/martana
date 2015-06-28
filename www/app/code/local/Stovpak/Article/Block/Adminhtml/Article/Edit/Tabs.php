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
 * Article admin edit tabs
 *
 * @category    Stovpak
 * @package     Stovpak_Article
 * @author      Ultimate Module Creator
 */
class Stovpak_Article_Block_Adminhtml_Article_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Initialize Tabs
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('article_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('stovpak_article')->__('Article'));
    }

    /**
     * before render html
     *
     * @access protected
     * @return Stovpak_Article_Block_Adminhtml_Article_Edit_Tabs
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_article',
            array(
                'label'   => Mage::helper('stovpak_article')->__('Article'),
                'title'   => Mage::helper('stovpak_article')->__('Article'),
                'content' => $this->getLayout()->createBlock(
                    'stovpak_article/adminhtml_article_edit_tab_form'
                )
                ->toHtml(),
            )
        );
        $this->addTab(
            'form_meta_article',
            array(
                'label'   => Mage::helper('stovpak_article')->__('Meta'),
                'title'   => Mage::helper('stovpak_article')->__('Meta'),
                'content' => $this->getLayout()->createBlock(
                    'stovpak_article/adminhtml_article_edit_tab_meta'
                )
                ->toHtml(),
            )
        );
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addTab(
                'form_store_article',
                array(
                    'label'   => Mage::helper('stovpak_article')->__('Store views'),
                    'title'   => Mage::helper('stovpak_article')->__('Store views'),
                    'content' => $this->getLayout()->createBlock(
                        'stovpak_article/adminhtml_article_edit_tab_stores'
                    )
                    ->toHtml(),
                )
            );
        }
        return parent::_beforeToHtml();
    }

    /**
     * Retrieve article entity
     *
     * @access public
     * @return Stovpak_Article_Model_Article
     * @author Ultimate Module Creator
     */
    public function getArticle()
    {
        return Mage::registry('current_article');
    }
}
