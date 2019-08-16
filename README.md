# Product Management System
This is a simple testing project which uses HTML/CSS/SCSS/PHP/JS and libraries/frameworks
like Bootstrap and jQuery. It utilizes specific directory and whole flow structure which is based on my previous
experiences with various PHP frameworks.

# Installing The Project
At first you'll have to clone the project:

``git clone git@bitbucket.org:heckslay/product-management-system.git ``

Afterwards, you must create .env.php file and fill it in with the same data as .env.dist.php contains. 
Don't forget to indicate actual database connection credentials and other values in .env.php. 

After this you should run migrations to create database tables and relations.

From the project root directory run:

``php database/migrateUp.php``

If later you'll want to revert the migrations, you can simply run:


``php database/migrateDown.php``

This project utilizes SCSS as the CSS preprocessor, therefore, if changes are made to the source file,
you might want to build it. To run the build command, simply run the following command from the project's
root directory:

``npm run build:sass``

In case, you'd like to run the compilation process on each change of the source file, you'd better run the following
CLI command:

``npm run watch:sass``
