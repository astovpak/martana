<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stovpak_Slider_Block_Adminhtml_Slider extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_slider';
        $this->_blockGroup = 'slider';
        $this->_headerText = Mage::helper('slider')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('slider')->__('Add Item');
        parent::__construct();
    }
}