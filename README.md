# Invoice Manager
- Name: Jonathan An
- Student Number: 41197030
- Section Number: 26S CST8257 300



## 1. Beyond incorporating the invoice_manager.sqlite database, what other refactoring did you do for this part of the project?
The invoice form in update.php and add.php was redundant as it was implemented in both pages separately. So, I refactored it so that update.php and add.php each maintain their respective functionalities, while both using the same form in invoice-form.php with `<?php require_once 'invoice-form.php'; ?>` near the end of both files. In invoice-form.php, it checks for pre-existing data (which would come from update.php), otherwise leave the inputs in the form as blank (which would be the case if a user is adding a new invoice). And update.php and add.php both set a value for $formType as "update" or "add" respectively, which determines the post type and UI elements accordingly.

## 2. How well did GitHub Copilot incorporate the database into the project? What challenges did you face? What specific context or prompts did you need to use?
It appears that it has refactored the project very well. I used the prompt `Refactor this project: instead of retrieving data from data.php, use invoice_manager.sqlite.` It maintained the functionality, and data validation and sanitization from the previous assignment. It took a long time to process as this single prompt used more monthly Co-Pilot credit than any other prompts I have used. It required permission to access Powershell multiple times in order to connect to the .sqlite file.

## 3. If you were required to refactor the project to use a PostgreSQL database instead of a SQLite database including creating the tables based off the SQLite data, how would you prompt GitHub Copilot to perform this task?
In previous semesters, I have studied MySQL instead of PostgresSQL, so I will refer to MySQL. I am assuming that MySQL and related software are already installed on the PC.

I would prompt the AI to generate MySQL commands that would generate an equivalent table in MySQL. Then, I would copy and paste the MySQL commands into MySQL Workbench to create a new database and table with the same data as invoice_manager.sqlite. Then I would prompt it to change the PHP codebase to refactor all connections to invoice_manager.sqlite to the equivalent MySQL database--more or less using it to "search and replace" the outdated code.