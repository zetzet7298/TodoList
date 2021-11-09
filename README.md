TodoList
web system to manage work named “TodoList”

Functions to Add, Edit, Delete Work. A work includes information of “Work Name”, “Starting
Date”, “Ending Date” and “Status” (Planning, Doing, Complete)

Function to show the works on a calendar view with: Date, Week, Month

Root path: /Todolist/index.php
<br />
uri:<br />
/?controller=work&action=index (GET): Index work page<br />
/?controller=work&action=store (POST): Store work<br />
/?controller=work&action=update&id={id} (POST): Update work <br />
/?controller=work&action=destroy&id={id} (POST): Delete work <br />
/?controller=work&action=getDataAsJson (GET): Get list works. Response as json <br />
/?controller=work&action=getWorkByIdAsJson&id={id}(GET): Get work by id <br />
/?controller=work&action=updateStatus&id={id}: Update work status by id (api) <br />

From root folder path : /TodoList type command ./vendor/bin/phpunit to run unit test


feature b
