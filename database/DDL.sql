CREATE TABLE category(
	category_id int PRIMARY KEY AUTO_INCREMENT,
	category_name varchar(100) UNIQUE
);

CREATE TABLE menu(
	menu_id int PRIMARY KEY AUTO_INCREMENT,
	menu_name varchar(100),
	menu_price DECIMAL(10,2),
	category_id int, 
	foreign key fk_category(category_id) references category(category_id) on delete cascade on update cascade 
);


INSERT INTO `category`(`category_name`) VALUES 
('Appetizers'),
('Drinks');

INSERT INTO `menu`(`menu_name`, `menu_price`, `category_id`) VALUES 
('Chicken Fingers', 2.4, 1),
('Chicken Wings', 1.8, 1),
('Family Feast', 9.9, 1),
('Jalapeno Cheese Bites', 3.5, 1),
('Large Pizza', 3.4, 1),
('Potato wedges', 1, 1),
('Pepperon i special', 1.5, 1),
('Labnah zataar', 1.5, 1),
('Jumbo slice meal', 2.8, 1),
('Garlic Bread', 1.2, 1),
('Coca Cola', 0.7, 2),
('Fanta Orange', 0.7, 2),
('Sprite', 0.7, 2),
('Water', 0.3, 2),
('Lemon and mint mojito', 2.2, 2),
('Summer Wibes', 2.6, 2);


CREATE TABLE users(
	id int PRIMARY KEY AUTO_INCREMENT,
	name varchar(50),
	email varchar(50) UNIQUE,
	phone varchar(15) UNIQUE,
	address text,
	password varchar(100),
	type ENUM('guest', 'member', 'admin')
);

INSERT INTO `users`( `name`, `email`, `phone`, `password`, `type`) VALUES ('admin', 'admin@gmail.com', 98009887, md5(12345), 'admin');

CREATE TABLE booking(
	booking_id int PRIMARY KEY AUTO_INCREMENT,
	user_id int,
	booking_date date,
	booking_time time,
	noOfPerson int,
	person_ages varchar(50),
	booking_type ENUM('takeAway', 'dineIn', 'seaView'),
	booking_limit varchar(50),
	payment_mode varchar(50),
	payment_amount DECIMAL(10, 1),
	payment_status ENUM('paid', 'unpaid', 'pending') DEFAULT 'unpaid',
	foreign key fk_user(user_id) REFERENCES users(id)  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE foodBooking(
	food_booking_id int PRIMARY KEY AUTO_INCREMENT,
	food_id int,
	booked_id int,
	food_name varchar(100),
	food_price DECIMAL(10,1),
	food_qty int,
	foreign key fk_booking(booked_id) REFERENCES booking(booking_id),
	foreign key fk_food(food_id) REFERENCES menu(menu_id)  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE payment_detail(
	payment_detail_id int PRIMARY KEY AUTO_INCREMENT,
	pay_booking_id int,
	fname varchar(100),
	lname varchar(100),
	cardNo varchar(50),
	cvv varchar(3),
	expiry DATE,
	foreign key fk_booking1(pay_booking_id) REFERENCES booking(booking_id)  ON DELETE CASCADE ON UPDATE CASCADE
);