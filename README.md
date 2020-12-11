# ProjectManagementSystem

This project is based on laravel framework.
Admin has all privilege where as employee has certain restriction to access.By default You can register as an employee:
http://127.0.0.1:8000/register

## You can engage in this project to make this more advanced and you can add new features.You contribution will be highly appreciated !!

## Screenshots

### Login page
![login page](images/login.jpg)

### Register page
![register_page](images/register.jpg)

### Team management - team list
![teamTable](images/teamList.jpg)

### Team management - new team
![addTeam](images/addTeam.jpg)

### Team management - edit team
![editTeam](images/editTeam.jpg)

### User management - user list
![userList](images/userList.jpg)

### Team management - add employer
![addUser](images/addUser.jpg)


## Description
This project is for team & project management.
Employee can register himself and join to specific team.
Employer can assign new project to the team.

## Clone the repo
git clone https://github.com/cristian1201/Project-Management-Laravel.git

## Composer install
cd Project-Management-Laravel
composer install

# Migrate database and seed
Ajust the database information, then:

php artisan migrate --seed

# Login credentials
Admin Account: ['username' => 'admin', 'password' => 'admin'] <br>

Employee Account: 
- ['username' => 'user1', 'password' => 'asdf'] <br>
- ['username' => 'user2', 'password' => 'asdf'] <br>
- ['username' => 'user3', 'password' => 'asdf'] <br>


