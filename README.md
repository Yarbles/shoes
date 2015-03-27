Shoe Store App

Copyright 2015 Reid Baldwin


Languages: PHP with Silex and Twig

License: Creative Commons

Description: An app that creates and modifies shoe stores and brands of shoes and allows the user to see which stores carries a particular brand and vice versa.

Directions: start a local PHP host (in the web folder) on a computer with Silex and Twig installed and load from the root. Start a postgres session in the project folder and enter the PSQL commands (listed below) to create the necessary database (you should probably spell 'brands' properly the first time though).


PSQL commands:

Guest=# CREATE database shoes;
CREATE DATABASE
Guest=# \c shoes
You are now connected to database "shoes" as user "Guest".
shoes=# CREATE TABLE stores (id serial PRIMARY KEY, store_name varchar);
CREATE TABLE
shoes=# CREATE TABLE brans (id serial PRIMARY KEY, brand_name varchar);
CREATE TABLE
shoes=# DROP TABLE brans;
DROP TABLE
shoes=# CREATE TABLE brands (id serial PRIMARY KEY, brand_name varchar);
CREATE TABLE
shoes=# CREATE TABLE stores_brands (id serial PRIMARY KEY, brand_id int, store_id int);
CREATE TABLE
shoes=# CREATE DATABASE shoes_test WITH TEMPLATE shoes;
CREATE DATABASE
shoes=# \c shoes_test;
You are now connected to database "shoes_test" as user "Guest".
shoes_test=#
