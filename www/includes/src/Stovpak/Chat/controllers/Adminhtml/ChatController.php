<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stovpak_Chat_Adminhtml_ChatController extends Mage_Adminhtml_Controller_Action
{
 
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('chat/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }   
   
    public function indexAction() {
       $this->_initAction();       
       $this->_addContent($this->getLayout()->createBlock('chat/adminhtml_chat'));
       $this->renderLayout();
        
    }
 
    public function editAction()
    {
        $chatId     = $this->getRequest()->getParam('id');
        $chatModel  = Mage::getModel('chat/chat')->load($chatId);
 
        if ($chatModel->getId() || $chatId == 0) {
 
            Mage::register('chat_data', $chatModel);
 
            $this->loadLayout();
            $this->_setActiveMenu('chat/items');
           
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
           
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
           
            $this->_addContent($this->getLayout()->createBlock('chat/adminhtml_chat_edit'))
                 ->_addLeft($this->getLayout()->createBlock('chat/adminhtml_chat_edit_tabs'));
               
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('chat')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }
   
    public function newAction()
    {
        $this->_forward('edit');
    }
   
    public function saveAction()
    {
        if ( $this->getRequest()->getPost() ) {
        
            try {
                if(isset($_FILES['file']['name']) and (file_exists($_FILES['file']['tmp_name']))) {
                   $uploader = new Varien_File_Uploader('file');
                   $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); // or pdf or anything 
                   $uploader->setAllowRenameFiles(false); 
                   $uploader->setFilesDispersion(false);   
                   $path = Mage::getBaseDir('media').'/chat' ;               
                   $uploader->save($path, $_FILES['file']['name']); 
                   //$data['fileinputname'] = $_FILES['fileinputname']['name']; 
               }
                
                $postData = $this->getRequest()->getPost();
                if(isset($_FILES['file']['name'])&&!$_FILES['file']['name']==''){
                    $file_path='/chat/'.$_FILES['file']['name'];
                }
                else {
                    $file_path=$postData['filename'];
                }
                
                $chatModel = Mage::getModel('chat/chat');
               
                $chatModel->setId($this->getRequest()->getParam('id'))
                    ->setTitle($postData['title'])
                    ->setContent($postData['content'])
                    ->setWeight($postData['weight'])
                    ->setStatus($postData['status'])                
                    ->setFile($file_path)                   
                    ->setUpdate_time(now());
                if(!$chatModel->getCreated_time()){
                 $chatModel->setCreated_time(now());
                }
                  
                $chatModel->save();
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setChatData(false);
 
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setChatData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
   
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $chatModel = Mage::getModel('chat/chat');
               
                $chatModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                   
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
    /**
     * Product grid for AJAX request.
     * Sort and filter result for example.
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('chat/adminhtml_chat_grid')->toHtml()
        );
    }
}