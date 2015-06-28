-- add table prefix if you have one
DROP TABLE IF EXISTS stovpak_article_article_store;
DROP TABLE IF EXISTS stovpak_article_article;
DELETE FROM core_resource WHERE code = 'stovpak_article_setup';
DELETE FROM core_config_data WHERE path like 'stovpak_article/%';