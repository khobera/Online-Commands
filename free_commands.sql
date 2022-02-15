create database free_Commands;
use free_commands;
create table customers
(
customerid int unsigned not null auto_increment primary key,
name char(60) not null,
address char(80) not null,
city char(30) not null,
state char(20),
zip char(10),
country char(20) not null
) type=InnoDB;
create table orders
(
orderid int unsigned not null auto_increment primary key,
customerid int unsigned not null references customers(customerid),
amount float(6,2),
date date not null,
order_status char(10),
ship_name char(60) not null,
ship_address char(80) not null,
ship_city char(30) not null,
ship_state char(20),
ship_zip char(10),
ship_country char(20) not null
) type=InnoDB;
create table videos
(
isbn char(13) not null primary key,
author char(100),
title char(100),
catid int unsigned,
description varchar(255)
) type=InnoDB;
create table categories
(
catid int unsigned not null auto_increment primary key,
catname char(60) not null
) type=InnoDB;
create table order_items
(
orderid int unsigned not null references orders(orderid),
isbn char(13) not null references books(isbn),
item_price float(4,2) not null,
quantity tinyint unsigned not null,
primary key (orderid, isbn)
) type=InnoDB;
create table admin
(
username char(16) not null primary key,
password char(12) not null,
email char(20)not null
);
grant select, insert, update, delete
on free_commands.*
to free_commands@localhost identified by 'password' 'email';