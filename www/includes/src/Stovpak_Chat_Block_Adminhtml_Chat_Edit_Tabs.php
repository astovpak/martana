<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stovpak_Chat_Block_Adminhtml_Chat_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('chat_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('chat')->__('News Information'));
    }
 
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('chat')->__('Item Information'),
            'title'     => Mage::helper('chat')->__('Item Information'),
            'content'   => $this->getLayout()->createBlock('chat/adminhtml_chat_edit_tab_form')->toHtml(),
        ));
       
        return parent::_beforeToHtml();
    }
}