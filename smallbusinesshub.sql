
CREATE DATABASE IF NOT EXISTS smallbusinesshub;
use smallbusinesshub;

CREATE TABLE `account_type` (
  `account_type_id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
); 
/* Inserting Values */
INSERT INTO account_type (account_type_id, description)
VALUES ('1', 'General User');

INSERT INTO account_type (account_type_id, description)
VALUES ('2', 'Business');

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_type_id` int(11) NOT NULL
);
CREATE TABLE `subscription` (
  `subscription_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `max_posts` int(11) NOT NULL
);
/* Inserting Values */
INSERT INTO subscription (subscription_id, name,max_posts)
VALUES ('1', 'Subscription 1', '10');

INSERT INTO subscription (subscription_id, name,max_posts)
VALUES ('2', 'Subscription 2', '25');

INSERT INTO subscription (subscription_id, name,max_posts)
VALUES ('3', 'Subscription 3', '55');

INSERT INTO subscription (subscription_id, name,max_posts)
VALUES ('4', 'Subscription 4', '100');

CREATE TABLE `business_information` (
  `business_id` int(11) NOT NULL,
   `image` longblob NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `address_street` varchar(255) NOT NULL,
  `address_district` varchar(255) NOT NULL,
  `address_city` varchar(255) NOT NULL,
  `address_number` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `facebook_url` varchar(255)  NULL,
  `instagram_url` varchar(255)  NULL,
  `twitter_url` varchar(255)  NULL,
  `website_url` varchar(255)  NULL,
  `email` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL
);

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `saves` int(11) NOT NULL,
  `boost` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `general_user_information` (
  `general_user_id` int(11) NOT NULL,
  `image` longblob NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `account_id` int(11) NOT NULL 
);

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
);

/* Inserting Values */
INSERT INTO category (category_id, name, description)
VALUES ('1', 'Health', 'Store contains health-based items.');

INSERT INTO category (category_id, name, description)
VALUES ('2', 'Entertainment', 'Store contains entertainment-based items.');

INSERT INTO category (category_id, name, description)
VALUES ('3', 'Clothing', 'Store contains clothing-based items.');

INSERT INTO category (category_id, name, description)
VALUES ('4', 'Crafts', 'Store contains craft-based items.');

INSERT INTO category (category_id, name, description)
VALUES ('5', 'Hobbies', 'Store contains hobby-based items.');

INSERT INTO category (category_id, name, description)
VALUES ('6', 'Electronics', 'Store contains electronic-based items.');

CREATE TABLE `interests` (
  `interest_id` int(11) NOT NULL,
  `general_user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL 
);

CREATE TABLE `business_category` (
  `business_category_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL 
);

CREATE TABLE `saves` (
  `save_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `general_user_id` int(11) NOT NULL 
);

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL 
);

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `general_user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE `account_type`
  ADD PRIMARY KEY (`account_type_id`),
  MODIFY `account_type_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscription_id`),
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,
  ADD UNIQUE KEY `name` (`name`);

ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT,
  ADD UNIQUE KEY `username` (`username`),
  ADD CONSTRAINT `account_FK` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`account_type_id`);

ALTER TABLE `general_user_information`
  ADD PRIMARY KEY (`general_user_id`),
  MODIFY `general_user_id` int(11) NOT NULL AUTO_INCREMENT,
  ADD CONSTRAINT `general_user_account_id_FK` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

ALTER TABLE `business_information`
  ADD PRIMARY KEY (`business_id`),
  MODIFY `business_id` int(11) NOT NULL AUTO_INCREMENT,
  ADD CONSTRAINT `business_information_id_FK` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  ADD CONSTRAINT `subscription_id_FK` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`subscription_id`);

ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,
  ADD CONSTRAINT `business_information_id_posts_id` FOREIGN KEY (`business_id`) REFERENCES `business_information` (`business_id`);

ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  ADD CONSTRAINT `comment_general_user_id_FK` FOREIGN KEY (`general_user_id`) REFERENCES `general_user_information` (`general_user_id`),
  ADD CONSTRAINT `comment_post_id_FK` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

ALTER TABLE `interests`
  ADD PRIMARY KEY (`interest_id`),
  MODIFY `interest_id` int(11) NOT NULL AUTO_INCREMENT,
  ADD CONSTRAINT `interest_general_user_id_FK` FOREIGN KEY (`general_user_id`) REFERENCES `general_user_information` (`general_user_id`),
  ADD CONSTRAINT `interest_category_id_FK` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

ALTER TABLE `business_category`
  ADD PRIMARY KEY (`business_category_id`),
  MODIFY `business_category_id` int(11) NOT NULL AUTO_INCREMENT,
  ADD CONSTRAINT `business_category_user_id_FK` FOREIGN KEY (`business_id`) REFERENCES `business_information` (`business_id`),
  ADD CONSTRAINT `business_category_id_FK` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`),
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  ADD CONSTRAINT `tag_post_id_FK` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);