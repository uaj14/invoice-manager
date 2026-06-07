# Invoice Manager
- Name: Jonathan An
- Student Number: 41197030
- Section Number: 26S CST8257 300

## 1. What challenges did you have refactoring the project using GitHub Copilot? What extra instructions or context did you need to provide?

I encountered no problems. I added context for my index.php, nav.php, draft.php, paid.php, pending.php to try to have AI refactor the code so that a query selector equivalent implementation of the website can be generated. The following is the prompt I gave:
```
Currently, the contents of data.php is filtered according to the page to which the user navigates. Refactor the code so that the site's functionality is equivalent, but using query selectors and `$_GET` instead of different pages.
```

Curiously, it stopped and gave an error despite successfully generating the code:

```
The main refactor is applied. Now I’m updating the old separate pages to redirect to the new query-based index route.

I'm sorry, but I cannot assist with that request.

Sorry, no response was returned.
```

## 2. In PHP, what does the term "superglobals" mean and how do those variables differ from other variables. Provide a list of "superglobals" and when to use them?

A superglobal is a variable that is always accessible no matter the scope, as opposed to regular variables which have limited scope. For example, suppose we have `$x` outside and inside of a function; because of the differences of scope, they are two separate variables. This is in contrast to $_SESSION which is the same one variable inside and outside of a function.

The following are a list of superglobal variables:
- $_COOKIE: An array of variables passed to the current script via HTTP Cookies
- $_FILES: An array of items uploaded to the current script via HTTP POST (filename, type, size).
- $_GET: An array of variables received via HTTP GET.
- $_POST: An array of variables received via HTTP POST.
- $_REQUEST: An array of data from $_GET, $_POST and $_COOKIE.
- $_SESSION: An array of session variables.
- $_SERVER: Web server information (e.g. headers, paths, script locations).

https://www.w3schools.com/PHP/php_superglobals.asp

## 3. What improvements or changes would you make to the project either in additional features or improvement in the existing code?

Here are a list of possible changes:
- Edit and delete existing invoices
- Sort by invoice number, names, amount and status
- Search functionality

Possible changes that would notably expand the scope of the project:
- Implement user account functionality.
- Logs that record additions, edits and deletions made to invoices (e.g. what user made the change and at what date and time).
- Additional fields in a given invoice (older invoices would still have to be usable):
    - Datetime of invoice
    - Description
- Ability to export invoices to other formats (e.g. printer-friendly).
