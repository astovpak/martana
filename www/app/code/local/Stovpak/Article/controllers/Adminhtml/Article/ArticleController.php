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
 * Article admin controller
 *
 * @category    Stovpak
 * @package     Stovpak_Article
 * @author      Ultimate Module Creator
 */
class Stovpak_Article_Adminhtml_Article_ArticleController extends Stovpak_Article_Controller_Adminhtml_Article
{
    /**
     * init the article
     *
     * @access protected
     * @return Stovpak_Article_Model_Article
     */
    protected function _initArticle()
    {
        $articleId  = (int) $this->getRequest()->getParam('id');
        $article    = Mage::getModel('stovpak_article/article');
        if ($articleId) {
            $article->load($articleId);
        }
        Mage::register('current_article', $article);
        return $article;
    }

    /**
     * default action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_title(Mage::helper('stovpak_article')->__('Articles'))
             ->_title(Mage::helper('stovpak_article')->__('Articles'));
        $this->renderLayout();
    }

    /**
     * grid action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function gridAction()
    {
        $this->loadLayout()->renderLayout();
    }

    /**
     * edit article - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function editAction()
    {
        $articleId    = $this->getRequest()->getParam('id');
        $article      = $this->_initArticle();
        if ($articleId && !$article->getId()) {
            $this->_getSession()->addError(
                Mage::helper('stovpak_article')->__('This article no longer exists.')
            );
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getArticleData(true);
        if (!empty($data)) {
            $article->setData($data);
        }
        Mage::register('article_data', $article);
        $this->loadLayout();
        $this->_title(Mage::helper('stovpak_article')->__('Articles'))
             ->_title(Mage::helper('stovpak_article')->__('Articles'));
        if ($article->getId()) {
            $this->_title($article->getTitle());
        } else {
            $this->_title(Mage::helper('stovpak_article')->__('Add article'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    /**
     * new article action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * save article - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost('article')) {
            try {
                $article = $this->_initArticle();
                $article->addData($data);
                $imageName = $this->_uploadAndGetName(
                    'image',
                    Mage::helper('stovpak_article/article_image')->getImageBaseDir(),
                    $data
                );
                $article->setData('image', $imageName);
                $article->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('stovpak_article')->__('Article was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $article->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                if (isset($data['image']['value'])) {
                    $data['image'] = $data['image']['value'];
                }
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setArticleData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            } catch (Exception $e) {
                Mage::logException($e);
                if (isset($data['image']['value'])) {
                    $data['image'] = $data['image']['value'];
                }
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('stovpak_article')->__('There was a problem saving the article.')
                );
                Mage::getSingleton('adminhtml/session')->setArticleData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('stovpak_article')->__('Unable to find article to save.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * delete article - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function deleteAction()
    {
        if ( $this->getRequest()->getParam('id') > 0) {
            try {
                $article = Mage::getModel('stovpak_article/article');
                $article->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('stovpak_article')->__('Article was successfully deleted.')
                );
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('stovpak_article')->__('There was an error deleting article.')
                );
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('stovpak_article')->__('Could not find article to delete.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * mass delete article - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massDeleteAction()
    {
        $articleIds = $this->getRequest()->getParam('article');
        if (!is_array($articleIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('stovpak_article')->__('Please select articles to delete.')
            );
        } else {
            try {
                foreach ($articleIds as $articleId) {
                    $article = Mage::getModel('stovpak_article/article');
                    $article->setId($articleId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('stovpak_article')->__('Total of %d articles were successfully deleted.', count($articleIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('stovpak_article')->__('There was an error deleting articles.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass status change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massStatusAction()
    {
        $articleIds = $this->getRequest()->getParam('article');
        if (!is_array($articleIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('stovpak_article')->__('Please select articles.')
            );
        } else {
            try {
                foreach ($articleIds as $articleId) {
                $article = Mage::getSingleton('stovpak_article/article')->load($articleId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d articles were successfully updated.', count($articleIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('stovpak_article')->__('There was an error updating articles.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * export as csv - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportCsvAction()
    {
        $fileName   = 'article.csv';
        $content    = $this->getLayout()->createBlock('stovpak_article/adminhtml_article_grid')
            ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as MsExcel - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportExcelAction()
    {
        $fileName   = 'article.xls';
        $content    = $this->getLayout()->createBlock('stovpak_article/adminhtml_article_grid')
            ->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as xml - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportXmlAction()
    {
        $fileName   = 'article.xml';
        $content    = $this->getLayout()->createBlock('stovpak_article/adminhtml_article_grid')
            ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Check if admin has permissions to visit related pages
     *
     * @access protected
     * @return boolean
     * @author Ultimate Module Creator
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/stovpak_article/article');
    }
}
