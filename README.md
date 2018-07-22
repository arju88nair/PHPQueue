# PHP-Queue
a PHP RESTful API to work with the queue system in order to insert and retrieve queue entries from the database .

---
# Scenario

---
## Requirements
Can run on PHP 5.6+ (As far as I tested)

## Methods 

| Method | Data Type | Path | Purpose |
|--------|--------|--------|--------|
| GET    | JSON |/queue  |Retrieves all the entries queued today|
| POST    | JSON |/queue  |Create a new entry into the queue table with the current timestamp|

## Installations
1. Crete database(queue_system) in your Mysql

2. Run the SQL script in file **data.sql** to create the database table with some enteries

3. After the required DB configurations, can run the given **worker.sh** as a cron job by
  ```
  * * * * * sh /var/www/html/Queue/worker.sh
  
  ```
  which will run the script every minute and can act as a rate limiter
  
  
