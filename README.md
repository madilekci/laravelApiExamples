## Test Projesi

Bu projede basit düzeyde Laravel Api işlemlerinin örneklerini  görebilirsiniz.

## Kurulum Adımları

- Clone project from GitHub.

- Copy and change the lines in the .env.example file for database access :
    DB_DATABASE=example_db
    DB_USERNAME=root
    DB_PASSWORD=
then rename it to “.env”

- Run the “init.sh” script to execute following commands from command line : 
    composer update
    php artisan passport:install
    php artisan key:generate
    php artisan migrate
    php artisan db:seed

<hr>
<pre>
By completing these steps; We installed the necessary packages, made the necessary settings for the database connection,
and created the tables.
If you followed the steps correctly and everything is fine, there should be 3 records created using "factory"
for customers and one admin user in the users table. 
</pre>

## All passwords are set to "password".
 	Email address of the admin user: admin@admin.com

<pre>
Everything is now ready to use the APIs in the project.
To get started: You can get the email addresses of existing users 
by sending a GET request to http://127.0.0.1:8000/api/users.

You can use the "API DOC" for more information about how APIs can be used.
</pre>
