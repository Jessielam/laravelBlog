CREATE TABLE blog_user(
	`id` MEDIUMINT UNSIGNED NOT NULL auto_increment COMMENT '管理员id',
	`user_name` VARCHAR(50) NOT NULL COMMENT 'username',
	`user_pass` VARCHAR(255) NOT NULL COMMENT 'password',
	PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT Charset=utf8 COMMENT 'administor';

DROP TABLE IF EXISTS blog_category;
CREATE TABLE blog_category(
	`cate_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'CATEGORY ID',
	`cate_name` VARCHAR(50) NOT NULL COMMENT '分类名称',
	`cate_desc` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '分类描述',
	`cate_keywords` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'SEO 关键字',
	`cate_description` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'SEO 描述',
	`cate_view` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '查看次数',
	`cate_sort` INT(10) NOT NULL DEFAULT 100 COMMENT '分类排序',
	`cate_pid` MEDIUMINT UNSIGNED NOT NULL COMMENT '分类父id',
	PRIMARY KEY(`cate_id`),
	KEY cate_name(`cate_name`),
	KEY cate_view(`cate_view`)
)ENGINE=INNODB DEFAULT Charset=utf8 COMMENT 'category';

DROP TABLE IF EXISTS blog_tag;
CREATE TABLE blog_tag(
	`tag_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'TAG ID',
	`tag_name` VARCHAR(50) NOT NULL COMMENT '分类名称',
	`created_at` INT NOT NULL DEFAULT 0 COMMENT '创建时间',
	PRIMARY KEY(`tag_id`),
	KEY tag_name(`tag_name`)
)ENGINE=INNODB DEFAULT Charset=utf8 COMMENT 'tag';

DROP TABLE IF EXISTS blog_article_tag;
CREATE TABLE blog_article_tag(
	`arc_id` MEDIUMINT UNSIGNED NOT NULL COMMENT 'article ID',
	`tag_id` MEDIUMINT UNSIGNED NOT NULL COMMENT 'tag ID',
	key arc_id(arc_id),
	key tag_id(tag_id)
)ENGINE=INNODB DEFAULT Charset=utf8 COMMENT '文章标签中间表';

DROP TABLE IF EXISTS blog_article;
CREATE TABLE blog_article(
	`arc_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'article ID',
	`arc_title` VARCHAR(45) NOT NULL COMMENT '文章标题',
	`arc_author` VARCHAR(45) NOT NULL COMMENT '作者',
	`arc_digest` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '摘要',
	`arc_content` TEXT COMMENT '文章内容',
	`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发表时间',
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
	`arc_click` INT NOT NULL DEFAULT 0 COMMENT '点击次数',
	`arc_thumb` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '图片',
	`cate_id` MEDIUMINT UNSIGNED NOT NULL COMMENT 'CATEGORY ID',
	PRIMARY KEY(`arc_id`),
	KEY arc_title(`arc_title`),
	KEY arc_author(`arc_author`),
	KEY cate_id(`cate_id`)
)ENGINE=INNODB DEFAULT Charset=utf8 COMMENT '文章表';