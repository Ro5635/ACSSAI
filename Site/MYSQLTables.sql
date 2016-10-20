MYSQL Tables 

-- To use this site the following tables need to be created on a mysql server that can be reached using the details provided in the config.php file
-- This file is provided for the recording of the tables that are required, it is never used in the execution of requests on the site.

CREATE TABLE LoginAttempts( AttemptID  int unsigned auto_increment Primary Key, AttemptedUserName varchar(250) NOT NULL , AttemptedAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP , LoginAttemptState  int unsigned  DEFAULT 0 );

CREATE TABLE Users( UserID int unsigned auto_increment, primary key(UserID  ,UserName), UserTokenHashed char(40) NOT NULL, UserName varchar(200) NOT NULL, FirstName varchar(200) NOT NULL, LastName varchar(200) NOT NULL , DateJoined timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, AccessType int unsigned);