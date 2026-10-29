CREATE DATABASE IF NOT EXISTS motoj_ims CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE motoj_ims;
CREATE TABLE IF NOT EXISTS inventory (
 id INT UNSIGNED NOT NULL AUTO_INCREMENT,
 item_name VARCHAR(150) NOT NULL,
 brand_model_variant VARCHAR(150) NOT NULL,
 quantity INT UNSIGNED NOT NULL,
 price DECIMAL(10,2) NOT NULL,
 date DATE NOT NULL,
 PRIMARY KEY(id),
 INDEX idx_inventory_item_name(item_name),
 INDEX idx_inventory_brand(brand_model_variant)
) ENGINE=InnoDB;
-- No unconfirmed sample inventory is inserted automatically.
