# Invoice Manager
- Name: Jonathan An
- Student Number: 41197030
- Section Number: 26S CST8257 300



## 1. What challenges did you face getting GitHub Copilot to properly incorporate form validation? How did GitHub Copilot validation code differ from what was taught in class?
When prompted, it generated the validation, sanitization and testing functionality in update.php and index.php with long, complex if statements. I re-prompted it to create a separate validate.php file where it would handle all of those functionalities. This separation of functionality has made the overall code more organized, hence more easily readable.

## 2. Did GitHub Copilot use any code that you didn't understand or made any changes that you didn't like? If so, explain. What did/would you do if there was generated code that you didn't understand?
There were a few of its its implementation that I did not understand, and they pertained to accessing data in the session.

1. Use of `&` in `foreach ($_SESSION["all_invoices"] as &$invoice) {`.
I learned that putting `&` in front of a variable makes it so that it is accessed by reference as opposed to getting a copy of its value. This way, the item in the original array can be modified. However, this approach is not in the finalized version of part-3 of the Invoice Manager.

2. Using `foreach ($_SESSION['all_invoices'] as $key => $invoice) {` instead of `foreach ($_SESSION['all_invoices'] as $invoice) {`
The latter line of code accesses the values of a given invoice, but its key (index) is not directly being kept track. The approach of the former is necessary because $key is needed to find the index of a particular invoice that is being deleted with the unset() function.


## 3. What changes would you make to the quality of your code? How would you prompt GitHub Copilot to make those changes?
As of writing, my part 3 of Invoice Manager seems to be working as expected. One potential area of further refinement would be to combine add.php and update.php as both pertain to dealing with invoice data with the same form. So, I would prompt AI to refactor add.php and update.php so that there is no duplicate code pertaining to the form itself, but to maintain separation between one handling the addition of new invoices, and the other handling the editing of existing invoices.
