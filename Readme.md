# Resilia Notifications Mini-system - Eric Montes de Oca

### **Explained Solution**
This Notifications system is based on the Training module from Resilia's Nonprofit Platform.

The main idea is that organizations have two types of users:
1) Regular users
2) Adminitrators

Therefore, we have two paths in the system. As a regular user, we can watch training courses and whenever we are done with a course a notification it's sent to the organization administrator to let them know the user has succesfully completed a course.

On the other hand, by logging in as an adminitrator, we are able to check the notifications created by the regular users activity in the platform.

The choosen stack of technologies for this exercise are:
- Laravel 8
- Vue 3

### Project Structure
This project is divided in two folders:
1) backend
2) frontend

The first one, includes a Laravel API that nurtrures content to the frontend. The frontend folder, includes all of the user interface and the connection to the backend to consume the information.


### Requisites
The notifications mini-systems makes use of Laravel 8, Vue 3, TailwindCSS, Vite, MySQL. In order to run this program the following tools are required:
`````
"composer": "^2.0"
"php": "^7.3|^8.0",
"laravel/framework": "^8.75",
"vue": "^3.2.45",
"vue-router": "^4.1.6",
"mysql": "^5.6"
`````

#### Installation
Here is a list of simple steps to install the project:

#### **Backend**
1) Go into /backend/
2) Create a copy of .enx.example using
````
cp .env.example .env
````
3) Configure database connection inside .env file
4) Run composer install to install project dependencies
````
composer install
````
5) Create APP_KEY by executing
````
php artisan key:generate
````
6) Ok, it's time to insert data into the DB:
````
php artisan migrate --seed
````
7) Now, the backend API it's ready, go to *Execution* to start the backend project.

#### **Frontend**
1) Go to /frontend/
2) Run the following command to install all dependencies:
````
npm install
````
3) Go to *Execution* to start the frontend project.

#### Execution
To run this project, you will need to start both backend and frontend projects:

#### Backend
To start a new laravel server locally, please go to /backend/ and execute:

`````
php artisan serve --port=5000
`````
NOTE: Port number can be repleaced, but it has to be replaced inside frontend folder in order to work.

#### Frontend
To start the Vue project, go to /frontend/ an execute:

`````
npm run dev
`````
This will start a instance of the project on default port, but it can be changed adding "--port [Port number]".