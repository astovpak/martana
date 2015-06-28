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
 * Article admin edit form
 *
 * @category    Stovpak
 * @package     Stovpak_Article
 * @author      Ultimate Module Creator
 */
class Stovpak_Article_Block_Adminhtml_Article_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'stovpak_article';
        $this->_controller = 'adminhtml_article';
        $this->_updateButton(
            'save',
            'label',
            Mage::helper('stovpak_article')->__('Save Article')
        );
        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('stovpak_article')->__('Delete Article')
        );
        $this->_addButton(
            'saveandcontinue',
            array(
                'label'   => Mage::helper('stovpak_article')->__('Save And Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ),
            -100
        );
        $this->_formScripts[] = "
            function saveAndContinueEdit() {
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * get the edit form header
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getHeaderText()
    {
        if (Mage::registry('current_article') && Mage::registry('current_article')->getId()) {
            return Mage::helper('stovpak_article')->__(
                "Edit Article '%s'",
                $this->escapeHtml(Mage::registry('current_article')->getTitle())
            );
        } else {
            return Mage::helper('stovpak_article')->__('Add Article');
        }
    }
}
