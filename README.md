
## Install Process

#step 1
make a clone of the project from this repository

#step 2
make sure you have "php v-7 or later" and "composer" installed
open comandprompt or console in the folder of the project and run command "composer update" 

#step 3
create a new database named "newcrud_db" in your phpmyadmin
I have given a database backup in the "database/backup/" if you want then import that on "newcrud_db" if you do not want to use my backup then run "php artisan migrate" on commandprompt or console
if you want to change the database name go to ".env" file and change "DB_DATABASE=newcrud_db" to your database name.

#final step

run "php artisan serve" on commandprompt or console then visit the respective link given from console like 
"localhost:8000 or http://127.0.0.1:8000" if you faceproblem running the project contact me (salehahammednoor@gmail.com) or visit http://newcrud.stunningtouch.com for demo.