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
 * Article widget block
 *
 * @category    Stovpak
 * @package     Stovpak_Article
 * @author      Ultimate Module Creator
 */
class Stovpak_Article_Block_Article_Widget_View extends Mage_Core_Block_Template implements
    Mage_Widget_Block_Interface
{
    protected $_htmlTemplate = 'stovpak_article/article/widget/view.phtml';

    /**
     * Prepare a for widget
     *
     * @access protected
     * @return Stovpak_Article_Block_Article_Widget_View
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        parent::_beforeToHtml();
        $articleId = $this->getData('article_id');
        if ($articleId) {
            $article = Mage::getModel('stovpak_article/article')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->load($articleId);
            if ($article->getStatus()) {
                $this->setCurrentArticle($article);
                $this->setTemplate($this->_htmlTemplate);
            }
        }
        return $this;
    }
}
