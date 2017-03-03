PDF Pages
---------
Ένα μικρό php script που επιστρέφει (βάσει ενος ευρετηρίου csv - αρχείου υπαλλήλων) ένα υποσύνολο (ένα PDF μίας ή περισσότερων σελίδων) ενός μεγάλου αρχείου PDF. Ιδανικό για ετήσιες βεβαιώσεις αποδοχών, ανακοινωτήρια κλπ.

από το [Βαγγέλη Ζαχαριουδάκη](http://github.com/sugarv)

**Οδηγίες**

1. Κάντε λήψη όλων των απαιτούμενων βιβλιοθηκών με τον [composer](https://getcomposer.org/) (γράφοντας <code>composer update</code>)
2. Αλλάξτε το αρχείο `config.php` σύμφωνα με τις ανάγκες σας
3. Δημιουργήστε το αρχείο csv των υπαλλήλων (χρησιμοποιώντας το αρχείο `data/employee_sample.csv`).
4. Ανεβάστε όλα τα αρχεία στο σέρβερ. Τα αρχεία csv & pdf πρέπει να βρίσκονται στο φάκελο `data`.
** ΠΡΟΣΟΧΗ: Το αρχείο PDF πρέπει να είναι τύπου PDF/A (v.1.4) **
5. Είστε έτοιμοι!


PDF Pages
---------
A small PHP script which returns (based on an csv index - employee file) a subset (a PDF of 1 or more pages) of a large PDF file.

by [Vangelis Zacharioudakis](http://github.com/sugarv)


**Instructions**

1. Get dependencies using [composer](https://getcomposer.org/) (execute `composer update`)
2. Alter `config.php` to fit your needs
3. Create employee csv file (using `data/employee_sample.csv`).
4. Upload all files to server. Csv & pdf files must be located in `data` folder.
** WARNING: PDF MUST be be PDF/A (v.1.4) **
5. You're ready to go!
