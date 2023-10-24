ALTER TABLE `shops` CHANGE `name` `name_en` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, CHANGE `address` `address_en` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, CHANGE `slug` `slug_en` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, CHANGE `meta_title` `meta_title_en` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, CHANGE `meta_description` `meta_description_en` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `shops`  ADD `name_ar` VARCHAR(100) NULL  AFTER `meta_description_en`,  ADD `meta_title_ar` VARCHAR(255) NULL  AFTER `name_ar`,  ADD `meta_description_ar` TEXT NULL  AFTER `meta_title_ar`,  ADD `address_ar` VARCHAR(255) NULL  AFTER `meta_description_ar`,  ADD `slug_ar` VARCHAR(225) NULL  AFTER `address_ar`;
ALTER TABLE `shops` DROP `slug_ar`;
ALTER TABLE `shops` CHANGE `slug_en` `slug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;