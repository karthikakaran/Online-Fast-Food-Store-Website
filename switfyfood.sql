drop database swiftyfood;
create database swiftyfood;
use swiftyfood;

CREATE TABLE userCredentials(userId INT auto_increment, userName varchar(15), password varchar(10), PRIMARY KEY (userId))AUTO_INCREMENT=2000; 
CREATE TABLE empDetails(empId INT auto_increment, empUserName varchar(15), password varchar(8), PRIMARY KEY (empId))AUTO_INCREMENT=5000;
CREATE TABLE userDetails(userId INT, userName varchar(15), emailId varchar(20),mobileNo varchar(10), aptNoName VARCHAR(30), place varchar(15), zipCode varchar(10), FOREIGN KEY (userId) REFERENCES userCredentials(userId), PRIMARY KEY (userId));

CREATE TABLE orderDetails(userId INT, orderNo INT auto_increment, orderDateTime DateTime, total decimal(4,2), tax decimal(4,2), totalPrice decimal(4,2), PRIMARY KEY (orderNo), FOREIGN KEY (userId) REFERENCES userCredentials(userId))AUTO_INCREMENT=1000;

CREATE TABLE itemDetails(itemNo INT auto_increment, name varchar(30), type varchar(15), nvOrVeg INT(1), description varchar(50), imgPath varchar(30), rate decimal(4,2), delFlag INT, PRIMARY KEY (itemNo))AUTO_INCREMENT=500;

CREATE TABLE orderedItemDetails(orderDetailsId INT auto_increment, orderNo INT, itemNo INT, quantity INT, FOREIGN KEY (orderNo) REFERENCES orderDetails(orderNo), FOREIGN KEY (itemNo) REFERENCES itemDetails(itemNo), PRIMARY KEY(orderDetailsId,orderNo))AUTO_INCREMENT=101;

insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Chicken Burger","Main", 2, "Chicken, patty, lettuce, crispy flakes, mexican sauce", "/images/Chicken burger.jpg", 5.00, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Beef Burger","Main", 2, "Beef patty, tomato, cheese, lettuce, sauce", "/images/Beef burger.jpg", 7.50, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Spicy Chicken Burger","Main", 2, "Chicken patty, lettuce, mustart suace, mexican sauce", "/images/Spicy chic burger.jpg", 6.80, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Egg Burger","Main", 2, "Egg, vegetable patty, tomato, cheese, lettuce, olives, sauce", "/images/Egg burger.jpg", 4.99, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Veggie  Burger","Main", 1, "Vegetable patty, tomato, cheese, lettuce, olives, sauce", "/images/Veggie burger.jpg", 4.99, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Tuna  Burger","Main", 2, "Fish patty, cheese, jalepenoes, olives, sauce", "/images/Tuna burger.jpg", 7.99, 0 );

insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Cheese pasta","Main", 1, "Fussili, cheese, jalepenoes, olives, mushroom", "/images/Cheese pasta.jpg", 8.99, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Cheese roll pizza","Main", 1, "Thin crust, cheese, tomatoes, olives, mushroom", "/images/Cheese roll pizza.jpg", 6.90, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Choco lava","Dessert", 1, "Chocolate, Browny", "/images/Choco lava.jpg", 3.90, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("CocaCola","Drink", 1, "Cola, artificial flavour, aerated", "/images/CocaCola drinks.jpg", 2.20, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Creamy chickenMac pasta","Main", 2, "Macroni, creamy sauce, chicken", "/images/Creamy chic mac.jpg", 8.20, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Egg roll","Side", 2, "Egg, wheat, vegetables", "/images/Egg roll.jpg", 4.45, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Fanta","Drink", 1, "Orange flavor, aerated", "/images/Fanta.jpg", 2.45, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Finger fries","Side", 1, "Potatoes, oil, salt", "/images/Finger fries.jpg", 1.55, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Flavored juice","Drink", 1, "Fruit flavor, natural", "/images/Flavored juice.jpg", 1.60, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("NorthWest Chicken Pizza","Main", 2, "Chicken, olives, cheese", "/images/NW Chic Pizza.jpg", 6.60, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Pepsi","Drink", 1, "Flavored drink, aerated", "/images/Pepsi.jpg", 2.90, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Springy potato fries","Side", 1, "Potatoes, spring type, oil, salt", "/images/Springy potato.jpg", 2.40, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Spagetti pasta","Main", 1, "Spagetti pasta, jalapenos, creamy sauce", "/images/Spagetti pasta.jpg", 4.90, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Sweet Cake","Dessert", 1, "Sugar, egg, wheat, milk", "/images/Sweet Cake.jpg", 1.90, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Veggie pizza","Main", 1, "Vegetables, wheat crust, olives, cheese", "/images/Veggie pizza.jpg", 5.10, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Veggie roll","Side", 1, "Vegetables, wheat, oil, sauce", "/images/Veggie roll.jpg", 2.10, 0 );
insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values("Veg penny pasta","Main", 1, "Vegetables, penny pasta, bell pepper, corn, sauce", "/images/Veg penny pasta.jpg", 4.35, 0 );