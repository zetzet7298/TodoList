TodoList
web system to manage work named “TodoList”

Functions to Add, Edit, Delete Work. A work includes information of “Work Name”, “Starting
Date”, “Ending Date” and “Status” (Planning, Doing, Complete)

Function to show the works on a calendar view with: Date, Week, Month

Root folder path: /Todolist/index.php

uri:
/?controller=work&action=index (GET): Index work page
/?controller=work&action=store (POST): Store work
/?controller=work&action=update&id={id} (POST): Update work 
/?controller=work&action=destroy&id={id} (POST): Delete work
/?controller=work&action=getDataAsJson (GET): Get list works. Response as json
/?controller=work&action=getWorkByIdAsJson&id={id}(GET): Get work by id
/?controller=work&action=updateStatus&id={id}: Update work status by id (api)