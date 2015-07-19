<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stovpak_Slider_Block_Adminhtml_Slider_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('sliderGrid');
        // This is the primary key of the database
        $this->setDefaultSort('slider_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('slider/slider')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('slider_id', array(
            'header'    => Mage::helper('slider')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'slider_id',
        ));
 
        $this->addColumn('title', array(
            'header'    => Mage::helper('slider')->__('Title'),
            'align'     =>'left',
            'index'     => 'title',
        ));
        $this->addColumn('file', array(
            'header'    => Mage::helper('slider')->__('File name'),
            'align'     =>'left',
            'index'     => 'file',
        ));
        
        $this->addColumn('content', array(
            'header'    => Mage::helper('slider')->__('Item Content'),
            'width'     => '150px',
            'index'     => 'content',
        ));
        $this->addColumn('weight', array(
            'header'    => Mage::helper('slider')->__('Weight'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'weight',
        ));
      
        $this->addColumn('created_time', array(
            'header'    => Mage::helper('slider')->__('Creation Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'created_time',
        ));
        
 
        $this->addColumn('update_time', array(
            'header'    => Mage::helper('slider')->__('Update Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'update_time',
        ));   
 
 
        $this->addColumn('status', array(
 
            'header'    => Mage::helper('slider')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => 'Active',
                0 => 'Inactive',
            ),
        ));
 
        return parent::_prepareColumns();
    }
 
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
 
    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
 
 
}