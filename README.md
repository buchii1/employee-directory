# Overview

## An Employee Management System
This is a basic program that helps an organization manage their employees, their contact information, and the departments in the organization. I wrote this project to demonstrate my ability of learning new programming concepts and being able to apply them in a new domain.

### Features
- Ability to `add` a new employee
- Ability to `edit` an employee
- Ability to `delete` an employee
- Ability to `add` a new department
- Ability to `add` select a department head from the list of employees
- Ability to `view` all the employees and the department they belong to.

### To run the program
- Clone the project repo to your local machine.
- If you are using Windows, download and install **XAMPP**.
- If you are using Mac, download and install **MAMP**.
- Open XAMPP/MAMP, turn on **Apache** and **MySQL**.
- Open a web broswer, and navigate to `localhost/phpmyadmin`.
- Go to Import Database, select the `employee-directory` sql file.
- It can be found under the sql directory of the project.
- Change the database connection details to match yours.
- The connection is located in the `functions.php` under the library directory.

# Relational Database
I made use of MySQL database.

### Table Structure

The SQL database is made up of three tables. 
- A table to store the `employee` information like employee name
- A table to store the `department` information like department name
- A table to store the `contact details` of each employee like phone number
  
# Development Environment

Code editor - **Visual Studio Code**
Programming language - **PHP 8.2** using the *MVC Architecture*
Database - **MySQL**

# Useful Websites

- [StackOverFlow - How can I solve MySQL shutdown unexpectedly](https://stackoverflow.com/questions/18022809/how-can-i-solve-error-mysql-shutdown-unexpectedly)
- [PHP Manual](https://www.php.net/manual/en/index.php)
- [StackOverFlow - Difference between inner, left, right and full join](https://stackoverflow.com/questions/5706437/whats-the-difference-between-inner-join-left-join-right-join-and-full-join)

# Future Work

- Implement the ability of letting employees add and edit their contact information.
- Implement the ability of letting managers/department heads add and assign projects.
- Implement role based-access.
