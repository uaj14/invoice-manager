# Invoice Manager
- Name: Jonathan An
- Student Number: 41197030
- Section Number: 26S CST8257 300



1. What was your experience using GitHub Copilot? How accurate and valid was the generated code? What worked and didn't work when using GitHub Copilot?

I find that using AI to generate code can be useful to quickly generate a sort of template or a starting basis to then further develop the project. For example, prompting it to generate a basic navigation bar and inserting it into each of the pages with "require", and generating a style.css file.

Also, it was useful for quickly doing tasks that are simple but tedious. For example, the navigation bar was initially inserted into each page with "include", and I prompted AI to replace them with "require" rather than manually changing each instance.

Besides that, I used AI largely to get explanations for certain PHP concepts.

While it strikes me how AI can reliably generate code that works, I am concerned about the potential for being dependent too much on it in the sense of having it generate code that I do not understand. So, I am less concerned about using it for generating scripts that I could do myself (such as style.css), but more concerned if there is potential that I may neglect opportunities to learn more about PHP.


2. How different was the generated coded compared to what you would have written? Did you make any changes to the generated code? Explain why or why not.

When it comes to coding that may be considered simple but tedious, I generally used what the AI generated (as mentioned in my answer to the previous question).

However, there is one example I found where my own research into a PHP concept ended up resulting in shorter code compared to what was generated. I looked into adapting code from the book list filtering application we covered in lab 2, as its concepts were applicable to this assignment. When I used AI, it generated the following code to filter books:

`$books = array_values(array_filter($books ?? [], function($b) { return !empty($b['haveRead']); }));`

However, to try to understand array_filter(), I watched a Youtube video explaining the concept: https://www.youtube.com/watch?v=HJUw_mMdryA

I noticed that the example shown in the video had no use for array_values(). So I removed it from the code, and using array_filter() alone still resulted in the expected behaviour. Perhaps there is a case where having array_filter() could be useful, but, as of now, it looks like this may be AI generating usable but unnecessary excess code.


3. What do you like and dislike about PHP so far? How does PHP differ from other programming languages you have used?

Knowing Javascript, PHP seems very familiar to me, albeit seemingly slightly more syntactically strict (such as each variable needing to start with `$`, and the requirement of ending a line of code with `;`.).

PHP (along with ASP.NET Razor which we are currently learning in the Web Programming Languages I course) is different from other programming languages I have learned as it is incorporated with HTML script; this is different from coding with Javascript as it is comparatively more separated from HTML script. To put it one way, PHP and HTML are both found in the same .php file, whereas Javascript and HTML are found in separate .js and .html files respectively. So far, I find that the tighter coupling between PHP and HTML makes it easier to make a dynamic webpage compared to JavaScript, which requires the use of methods in order to achieve the same effect.

What currently I do not like about PHP pertains to some aspects of its syntax. One being that variables require `$` at the beginning. The other is that the use of `<?php [insert code here] ?>` in order to use PHP code seems clunky; by comparison, although it does not quite the same way, ASP.NET Razor's `@[insert code here]` and `@{[insert code here]}` is more minimal syntactically when it comes to incorporating more dynamic aspects of the page.