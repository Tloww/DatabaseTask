# DatabaseTask

This project is a simple PHP + MySQL web application that allows you to:

- Add new users (name + age).
- Display all users in a table.
- Toggle user status between **0** and **1** with a button.
- Automatically update the status on the page without refreshing.

---

##  Features
- **Form Submission**: Insert new records into the database.
- **Data Display**: Show all users in a styled HTML table.
- **Toggle Button**: Change user status dynamically.
- **Auto Increment ID**: Each user gets a unique ID automatically.

---

##  Screenshots
### User Interface  
![Users Table Screenshot](https://github.com/Tloww/DatabaseTask/blob/main/Screenshot%202025-10-23%20015213.png)

### Example with Data  
![Users with Data Screenshot](https://github.com/Tloww/DatabaseTask/blob/main/Screenshot%202025-10-23%20020549.png)

---


### 1. Environment Setup
1. Install **XAMPP**.
2. Start **Apache** and **MySQL** from the XAMPP Control Panel.
3. Open phpMyAdmin at: `http://localhost/phpmyadmin`.

---

### 2. Create Database & Table

I created a database named **`tala`** with one table **`users`**.  
The table contains **4 columns** as follows:

1. **id**  
   - Type: `INT(11)`  
   - Attributes: `AUTO_INCREMENT`  
   - Key: `PRIMARY KEY`  
   - Description: Unique identifier for each user.  

2. **name**  
   - Type: `VARCHAR(50)`  
   - Description: Stores the name of the user.  

3. **age**  
   - Type: `INT(11)`  
   - Description: Stores the age of the user.  

4. **status**  
   - Type: `INT(11)` (could also be `TINYINT(1)`)  
   - Default: `0`  
   - Description: Represents the status (`0 = inactive`, `1 = active`).  

---

###  SQL Code

```sql
CREATE DATABASE IF NOT EXISTS tala
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE tala;

CREATE TABLE IF NOT EXISTS users (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  age INT(11) NOT NULL,
  status INT(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB;

