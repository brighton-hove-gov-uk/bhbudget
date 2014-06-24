bhbudget
========

Budget Planning tool developed for Brighton &amp; Hove by http://roughtype.co.uk/

=========

The Budget Tool (“Your money, your services”) is a small php/javascript web application which encourages the public to rank council spending areas in order of priority while imparting information about the size of budgets and the range of services provided.

The application has its own MySQL database, containing two tables: clicks and responses. The clicks table records every individual score for every service (if a person changes their score then it updates an existing record). The responses table records the user sessions (including email address if supplied). The tables can be joined on responses.id = clicks.user_id.

There is a database generating script included in the 'database' folder. This will make a database in mysql and then create the required tables. 


The application’s database connection is defined in the file bhcc.php.

There is no reporting facility within the application so data has to be exported (in csv format) from MySQL. I use the advanced settings to include column names on the first row. Note that the date and time is stored in UNIX format (seconds since 1 January 1970);  the following formula will convert the date in Excel: =CELL/(60*60*24)+"1/1/1970" and the cells need to given a custom format to show both date and time.
