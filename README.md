~~~sql
CREATE DATABASE CUSTOMER;
USE CUSTOMER;
CREATE TABLE customers (
  id integer primary key not null AUTO_INCREMENT,
  name varchar(255) not null,
  date varchar(10) not null,
  time integer not null
)
~~~