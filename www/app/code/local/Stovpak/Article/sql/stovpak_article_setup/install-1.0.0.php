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
 * Article module install script
 *
 * @category    Stovpak
 * @package     Stovpak_Article
 * @author      Ultimate Module Creator
 */
$this->startSetup();
$table = $this->getConnection()
    ->newTable($this->getTable('stovpak_article/article'))
    ->addColumn(
        'entity_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'identity'  => true,
            'nullable'  => false,
            'primary'   => true,
        ),
        'Article ID'
    )
    ->addColumn(
        'title',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
            'nullable'  => false,
        ),
        'Title'
    )
    ->addColumn(
        'abstract',
        Varien_Db_Ddl_Table::TYPE_TEXT, '64k',
        array(
            'nullable'  => false,
        ),
        'Abstract'
    )
    ->addColumn(
        'body',
        Varien_Db_Ddl_Table::TYPE_TEXT, '64k',
        array(
            'nullable'  => false,
        ),
        'Body'
    )
    ->addColumn(
        'image',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Image'
    )
    ->addColumn(
        'status',
        Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(),
        'Enabled'
    )
    ->addColumn(
        'url_key',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'URL key'
    )
    ->addColumn(
        'in_rss',
        Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(),
        'In RSS'
    )
    ->addColumn(
        'meta_title',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Meta title'
    )
    ->addColumn(
        'meta_keywords',
        Varien_Db_Ddl_Table::TYPE_TEXT, '64k',
        array(),
        'Meta keywords'
    )
    ->addColumn(
        'meta_description',
        Varien_Db_Ddl_Table::TYPE_TEXT, '64k',
        array(),
        'Meta description'
    )
    ->addColumn(
        'updated_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array(),
        'Article Modification Time'
    )
    ->addColumn(
        'created_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array(),
        'Article Creation Time'
    ) 
    ->setComment('Article Table');
$this->getConnection()->createTable($table);
$table = $this->getConnection()
    ->newTable($this->getTable('stovpak_article/article_store'))
    ->addColumn(
        'article_id',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        null,
        array(
            'nullable'  => false,
            'primary'   => true,
        ),
        'Article ID'
    )
    ->addColumn(
        'store_id',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        null,
        array(
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ),
        'Store ID'
    )
    ->addIndex(
        $this->getIdxName(
            'stovpak_article/article_store',
            array('store_id')
        ),
        array('store_id')
    )
    ->addForeignKey(
        $this->getFkName(
            'stovpak_article/article_store',
            'article_id',
            'stovpak_article/article',
            'entity_id'
        ),
        'article_id',
        $this->getTable('stovpak_article/article'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->addForeignKey(
        $this->getFkName(
            'stovpak_article/article_store',
            'store_id',
            'core/store',
            'store_id'
        ),
        'store_id',
        $this->getTable('core/store'),
        'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Articles To Store Linkage Table');
$this->getConnection()->createTable($table);
$this->endSetup();
