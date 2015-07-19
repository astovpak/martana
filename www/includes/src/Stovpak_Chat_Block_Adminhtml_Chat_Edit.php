<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stovpak_Chat_Block_Adminhtml_Chat_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
               
        $this->_objectId = 'id';
        $this->_blockGroup = 'chat';
        $this->_controller = 'adminhtml_chat';
 
        $this->_updateButton('save', 'label', Mage::helper('chat')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('chat')->__('Delete Item'));
    }
 
    public function getHeaderText()
    {
        if( Mage::registry('chat_data') && Mage::registry('chat_data')->getId() ) {
            return Mage::helper('chat')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('chat_data')->getTitle()));
        } else {
            return Mage::helper('chat')->__('Add Item');
        }
    }
}