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
 * Article admin widget controller
 *
 * @category    Stovpak
 * @package     Stovpak_Article
 * @author      Ultimate Module Creator
 */
class Stovpak_Article_Adminhtml_Article_Article_WidgetController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Chooser Source action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function chooserAction()
    {
        $uniqId = $this->getRequest()->getParam('uniq_id');
        $grid = $this->getLayout()->createBlock(
            'stovpak_article/adminhtml_article_widget_chooser',
            '',
            array(
                'id' => $uniqId,
            )
        );
        $this->getResponse()->setBody($grid->toHtml());
    }
}
