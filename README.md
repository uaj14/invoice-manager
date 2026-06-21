# Invoice Manager
- Name: Jonathan An
- Student Number: 41197030
- Section Number: 26S CST8257 300



## 1. Beyond incorporating the invoice_manager.sqlite database, what other refactoring did you do for this part of the project?


## 2. How well did GitHub Copilot incorporate the database into the project? What challenges did you face? What specific context or prompts did you need to use?
It appears that it has refactored the project very well. I used the prompt `Refactor this project: instead of retrieving data from data.php, use invoice_manager.sqlite.` It maintained the functionality, and data validation and sanitization from the previous assignment. It took a long time to process as this single prompt used more monthly Co-Pilot credit than any other prompts I have used. It required permission to access Powershell multiple times in order to connect to the .sqlite file.

## 3. If you were required to refactor the project to use a PostgreSQL database instead of a SQLite database including creating the tables based off the SQLite data, how would you prompt GitHub Copilot to perform this task?
It may be more complex than the following in practice, but I would at least try this:
`Convert invoice_manager.sqlite into PostgresSQL, and refactor this project to be connected to the new PostgresSQL data.`