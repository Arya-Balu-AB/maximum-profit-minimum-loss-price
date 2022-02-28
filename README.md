# maximum-profit-minimum-loss-price
The tool should take a CSV File and inputs on The Stock to Pick, Start and End Date of the range to be considered for Trading

Steps To Follow For the Task;

1. CREATE DATABASE stockdb;

2. CREATE TABLE stocks_list (
    id int(11) NOT NULL AUTO_INCREMENT,
    date date NOT NULL,
    stock_name varchar(255) NOT NULL,
    price int(55) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

3.Import CSV File to DataBase and it will Redirect to Home page;

4.Home page 

	-Select stock;
	-Pick a Buy Date;
	-Pick a Sell Date;
	-and That's it Done;

The Result Will Be Displayed on the empty DIV;

Thank you😊;
