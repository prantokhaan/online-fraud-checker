create database ofc;

use ofc;

create table users(
    id int primary key auto_increment,
    registerAs varchar(255) not null,
    fullName varchar(255) not null,
    shopName varchar(255),
    subscriberStatus varchar(255) not null, 
    age int not null,
    phoneNumber varchar(255) not null,
    address varchar(255) not null,
    username varchar(255) not null,
    password varchar(255) not null,
    email varchar(255) not null,
    rejectedCount int not null,
    accountStatus varchar(255) not null,
    created_at timestamp default current_timestamp
);

drop table users;

create table sellerComplain(
    id int primary key auto_increment,
    userName varchar(255) not null,
    sellerName varchar(255) not null,
    sellerEmail varchar(255) not null,
    sellerPhone varchar(255) not null, 
    sellerAddress varchar(255) not null,
    sellerFBLink varchar(255) not null,
    courierName varchar(255) not null,
    courierBookingId varchar(255) not null,
    orderedProduct varchar(255) not null,
    imageLink varchar(255) not null,
    complainStatus varchar(255) not null,
    created_at timestamp default current_timestamp
);

create table customerComplain(
    id int primary key auto_increment,
    userName varchar(255) not null,
    customerName varchar(255) not null,
    customerEmail varchar(255) not null,
    customerPhone varchar(255) not null, 
    customerAddress varchar(255) not null,
    customerFBLink varchar(255) not null,
    courierName varchar(255) not null,
    courierBookingId varchar(255) not null,
    orderedProduct varchar(255) not null,
    imageLink varchar(255) not null,
    complainStatus varchar(255) not null,
    created_at timestamp default current_timestamp
);

create table fakeCustomers(
    id int primary key auto_increment,
    customerName varchar(255) not null,
    customerEmail varchar(255) not null,
    customerPhone varchar(255) not null, 
    customerAddress varchar(255) not null,
    customerFBLink varchar(255) not null,
    complainCount int,
    created_at timestamp default current_timestamp
);

create table fakeSellers(
    id int primary key auto_increment,
    sellerName varchar(255) not null,
    sellerEmail varchar(255) not null,
    sellerPhone varchar(255) not null, 
    sellerAddress varchar(255) not null,
    sellerFBLink varchar(255) not null,
    complainCount int,
    created_at timestamp default current_timestamp
);

create table courierAccount(
    id int PRIMARY KEY AUTO_INCREMENT,
    courierName varchar(255) not null,
    courierPassword varchar(255) not null
);

insert into courierAccount(courierName, courierPassword)
values ('sundarban', 'sundarban'),
    ('pathao', 'pathao'),
    ('shohoz', 'shohoz'),
    ('lalamove', 'lalamove'),
    ('redx', 'redx'),
    ('paperfly', 'paperfly'),
    ('eCourier', 'eCourier'),
    ('deliverTiger', 'deliveryTiger'),
    ('korotoa', 'korotoa'),
    ('janani', 'janani'),
    ('seba', 'seba');

select * from courierAccount;


create table courier(
    id int PRIMARY KEY AUTO_INCREMENT,
    courierName varchar(255) not null,
    customerName varchar(255) not null,
    customerPhone varchar(255) not null,
    sellerName varchar(255) not null,
    sellerPhone varchar(255) not null,
    courierBookingId varchar(255) not null,
    orderedProduct varchar(255) not null,
    created_at timestamp default current_timestamp
);

select * from courier;


CREATE PROCEDURE IncrementComplainCount(
    IN customerId INT
)
BEGIN
    UPDATE fakeCustomers SET complainCount = complainCount + 1 WHERE id = customerId;
END

create Procedure IncrementSellerComplainCount(
    IN sellerId INT
)
BEGIN
    UPDATE fakeSellers SET complainCount = complainCount + 1 WHERE id = sellerId;
END



drop table users;


select * from users;
select * from sellerComplain;

select * from customerComplain;

select * from fakeCustomers;

select * from fakeSellers;

delete from courier;