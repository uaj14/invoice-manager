# Invoice Manager
- Name: Jonathan An
- Student Number: 41197030
- Section Number: **Course Section Number**



1. What was your experience using GitHub Copilot? How accurate and valid was the generated code? What worked and didn't work when using GitHub Copilot?

Pro: I find that using AI to generate code can be useful to quickly generate a sort of template or a starting basis to then further develop the project. For example, prompting it to generate a basic navigation bar, inserting it in each of the pages with "require" and a starting style.css file.

Also, it was useful in quickly doing tasks that are simple but tedious. For example, the navigation bar was inserted into each page with "include", and I prompted AI to replace them with "require" rather than manually changing each instance.

2. How different was the generated coded compared to what you would have written? Did you make any changes to the generated code? Explain why or why not.

There is one example I found where I think my own research into a PHP concept ended up resulting in shorter code compared to what was generated. I looked into adapting code from the book list filtering application we covered in lab 2, as its concepts were applicable to this assignment. When I used AI, it generated the following code to filter books:

`$books = array_values(array_filter($books ?? [], function($b) { return !empty($b['haveRead']); }));`

However, to try to understand array_filter(), I watched a Youtube video explaining the concept: https://www.youtube.com/watch?v=HJUw_mMdryA

I noticed that the example shown in the video had no use for array_values(). So I removed it from the code, and using array_filter() alone still resulted in the expected behaviour. Perhaps there is a case where having array_filter() could be useful, but, as of now, it looks like this may be AI generating usable but unnecessary excess code.


3. What do you like and dislike about PHP so far? How does PHP differ from other programming languages you have used?


