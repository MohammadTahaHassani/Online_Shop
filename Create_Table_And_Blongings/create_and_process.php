<?php
    include("../Product_Manager/Model_And_Class/database.php");

    $connection = Database::getDatabase();
    
    $query = "CREATE DATABASE Shop;
                USE Shop;
                CREATE TABLE Assignment(
                    desciption VARCHAR(128) NOT NULL,
                    status_id INT PRIMARY KEY AUTO_INCREMENT
                );

                CREATE TABLE Categories(
                    category_id INT PRIMARY KEY AUTO_INCREMENT,
                    category_name VARCHAR(128) NOT NULL
                );

                CREATE TABLE `Order`(
                    order_id INT PRIMARY KEY AUTO_INCREMENT ,
                    user_id INT NOT NULL,
                    product_id INT NOT NULL,
                    count INT NOT NULL ,
                    date DATETIME DEFAULT CURRENT_DATE NOT NULL ,
                    status VARCHAR(128) NOT NULL
                );

                CREATE TABLE Products(
                    product_id INT PRIMARY KEY AUTO_INCREMENT ,
                    category_id INT NOT NULL ,
                    name VARCHAR(128) NOT NULL ,
                    description TEXT NOT NULL ,
                    Price FLOAT NOT NULL ,
                    image_alt VARCHAR(128) NOT NULL ,
                    image_path VARCHAR(128) NOT NULL ,
                    image_1 VARCHAR(128) NOT NULL ,
                    image_2 VARCHAR(128) NOT NULL ,
                    image_3 VARCHAR(128) NOT NULL ,
                    last_edit DATE DEFAULT CURRENT_DATE
                );

                CREATE TABLE Users(
                    user_id INT PRIMARY KEY AUTO_INCREMENT ,
                    name VARCHAR(128) NOT NULL ,
                    family VARCHAR(128) NOT NULL ,
                    Phone VARCHAR(128) NOT NULL ,
                    email VARCHAR(128) NOT NULL ,
                    addresss VARCHAR(128) NOT NULL ,
                    username VARCHAR(128) NOT NULL ,
                    password VARCHAR(128) NOT NULL ,
                    status INT DEFAULT 1 NOT NULL
                );
                
                CREATE TABLE Comments(
                    comment_id INT PRIMARY KEY AUTO_INCREMENT,
                    comment TEXT NOT NULL,
                    product_id INT NOT NULL,
                    user_id INT NOT NULL,
                    comment_date DATE DEFAULT CURRENT_DATE NOT NULL
                )

                ALTER TABLE Users ADD FOREIGN KEY(status) REFERENCES Assignment(status_id);
                ALTER TABLE `Order` ADD FOREIGN KEY(user_id) REFERENCES Users(user_id);
                ALTER TABLE `Order` ADD FOREIGN KEY(product_id) REFERENCES Products(product_id);
                ALTER TABLE Products ADD FOREIGN KEY(category_id) REFERENCES Categories(category_id);
                ALTER TABLE Comments ADD FOREIGN KEY(product_id) REFERENCES Products(product_id);
                ALTER TABLE Comments ADD FOREIGN KEY(user_id) REFERENCES Users(user_id);";

    $connection->exec($query);
?>