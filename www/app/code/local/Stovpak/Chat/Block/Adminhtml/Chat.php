<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stovpak_Chat_Block_Adminhtml_Chat extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_chat';
        $this->_blockGroup = 'chat';
        $this->_headerText = Mage::helper('chat')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('chat')->__('Add Item');
        parent::__construct();
    }
}