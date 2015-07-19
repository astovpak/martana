<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stovpak_Slider_Block_Adminhtml_Slider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('slider_form', array('legend'=>Mage::helper('slider')->__('Item information')));
       
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('slider')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));
        $fieldset->addField('filename', 'hidden', array(
            
            'name'      => 'filename',
        ));
        $fieldset->addField('file', 'image', array(
          'label'     => Mage::helper('slider')->__('Image'),
          
          'name'      => 'file',
         
          
        ));
        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('slider')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('slider')->__('Active'),
                ),
 
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('slider')->__('Inactive'),
                ),
            ),
        ));
       
        $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('slider')->__('Content'),
            'title'     => Mage::helper('slider')->__('Content'),
            'style'     => 'width:98%; height:400px;',
            'wysiwyg'   => false,
            'required'  => false,
        ));
        $fieldset->addField('weight', 'text', array(
            'name'      => 'weight',
            'label'     => Mage::helper('slider')->__('Weight'),
            'default'   =>'0',
        ));
       
        if ( Mage::getSingleton('adminhtml/session')->getSliderData() )
        {  
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSliderData());
            Mage::getSingleton('adminhtml/session')->setSliderData(null);
        } elseif ( Mage::registry('slider_data') ) {
            $form->setValues(Mage::registry('slider_data')->getData());
            $form->getElement('filename')->setValue(Mage::registry('slider_data')->getData('file'));
       
            
        }
        return parent::_prepareForm();
    }
}