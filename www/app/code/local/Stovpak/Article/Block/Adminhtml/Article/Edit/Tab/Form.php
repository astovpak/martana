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
 * Article edit form tab
 *
 * @category    Stovpak
 * @package     Stovpak_Article
 * @author      Ultimate Module Creator
 */
class Stovpak_Article_Block_Adminhtml_Article_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return Stovpak_Article_Block_Adminhtml_Article_Edit_Tab_Form
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('article_');
        $form->setFieldNameSuffix('article');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'article_form',
            array('legend' => Mage::helper('stovpak_article')->__('Article'))
        );
        $fieldset->addType(
            'image',
            Mage::getConfig()->getBlockClassName('stovpak_article/adminhtml_article_helper_image')
        );
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig();

        $fieldset->addField(
            'title',
            'text',
            array(
                'label' => Mage::helper('stovpak_article')->__('Title'),
                'name'  => 'title',
            'note'	=> $this->__('Title of the article'),
            'required'  => true,
            'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'abstract',
            'editor',
            array(
                'label' => Mage::helper('stovpak_article')->__('Abstract'),
                'name'  => 'abstract',
            'config' => $wysiwygConfig,
            'note'	=> $this->__('Short description, abstract'),
            'required'  => true,
            'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'body',
            'editor',
            array(
                'label' => Mage::helper('stovpak_article')->__('Body'),
                'name'  => 'body',
            'config' => $wysiwygConfig,
            'note'	=> $this->__('Full content of the article'),
            'required'  => true,
            'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'image',
            'image',
            array(
                'label' => Mage::helper('stovpak_article')->__('Image'),
                'name'  => 'image',
            'note'	=> $this->__('Image'),

           )
        );
        $fieldset->addField(
            'url_key',
            'text',
            array(
                'label' => Mage::helper('stovpak_article')->__('Url key'),
                'name'  => 'url_key',
                'note'  => Mage::helper('stovpak_article')->__('Relative to Website Base URL')
            )
        );
        $fieldset->addField(
            'status',
            'select',
            array(
                'label'  => Mage::helper('stovpak_article')->__('Status'),
                'name'   => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('stovpak_article')->__('Enabled'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('stovpak_article')->__('Disabled'),
                    ),
                ),
            )
        );
        $fieldset->addField(
            'in_rss',
            'select',
            array(
                'label'  => Mage::helper('stovpak_article')->__('Show in rss'),
                'name'   => 'in_rss',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('stovpak_article')->__('Yes'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('stovpak_article')->__('No'),
                    ),
                ),
            )
        );
        if (Mage::app()->isSingleStoreMode()) {
            $fieldset->addField(
                'store_id',
                'hidden',
                array(
                    'name'      => 'stores[]',
                    'value'     => Mage::app()->getStore(true)->getId()
                )
            );
            Mage::registry('current_article')->setStoreId(Mage::app()->getStore(true)->getId());
        }
        $formValues = Mage::registry('current_article')->getDefaultValues();
        if (!is_array($formValues)) {
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getArticleData()) {
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getArticleData());
            Mage::getSingleton('adminhtml/session')->setArticleData(null);
        } elseif (Mage::registry('current_article')) {
            $formValues = array_merge($formValues, Mage::registry('current_article')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}
