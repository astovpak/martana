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
 * Article view block
 *
 * @category    Stovpak
 * @package     Stovpak_Article
 * @author      Ultimate Module Creator
 */
class Stovpak_Article_Block_Article_View extends Mage_Core_Block_Template
{
    /**
     * get the current article
     *
     * @access public
     * @return mixed (Stovpak_Article_Model_Article|null)
     * @author Ultimate Module Creator
     */
    public function getCurrentArticle()
    {
        return Mage::registry('current_article');
    }
}
