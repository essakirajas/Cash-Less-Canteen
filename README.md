# 💳 Cashless Canteen System

A smart RFID-based **Cashless Canteen System** built using **PHP**, **HTML**, **CSS**, **JavaScript**, and **MySQL** database. Designed for use with **Arduino + NodeMCU + RFID**, this system allows users to place orders, deposit cash, and view transaction history in a digital and contactless way.

---

## 📦 Tech Stack

- 🌐 **Frontend**: HTML, CSS, JavaScript  
- 🛠️ **Backend**: PHP  
- 🗃️ **Database**: MySQL  
- 🔌 **Hardware**: NodeMCU (ESP8266), RFID Module, Arduino

---

## 🛠️ Features

- 🧑‍🎓 User Registration and RFID Tagging  
- 💰 Balance Deposit System  
- 🍽️ Place Orders with RFID Card  
- 📄 View Transaction History and Receipts  
- 🔐 Admin Dashboard for managing users, orders, and data  
- 🖥️ Real-time UID scan and identification

---

## 📁 Project Structure

```

/cashless-canteen-system
├── css/                      # CSS styles
├── img/                      # Images
├── js/                       # JavaScript files
├── index.html                # Entry page
├── home.php                  # Main homepage after login
├── registration.php          # User registration
├── insertDB.php              # Insert RFID tag to DB
├── getUID.php                # Get scanned UID
├── UIDContainer.php          # Real-time UID container
├── add\_amount.php            # Deposit amount
├── place\_order.php           # Order food items
├── order\_history.php         # View user orders
├── bill.php / bill1.php / bill2.php     # Billing pages
├── student.php               # Student list view
├── recent\_recipt.php         # Last transaction slip
├── user data.php             # Manage users (admin)
├── user data edit page.php   # Edit user form
├── user data edit tb.php     # Update user handler
├── user data delete page.php # Delete user handler
├── database.php              # DB connection script
├── nodemcu\_rfid\_iot\_projects.sql        # MySQL DB (main)
├── nodemcu\_rfid\_iot\_projects(1).sql     # Backup DB file
└── README.md                 # Project documentation

````

---

## 🧪 How It Works

1. **RFID Registration**  
   Scan the RFID tag and register a new user.

2. **Cashless Transaction**  
   Use the RFID tag to order food; the amount is deducted from balance.

3. **Admin Panel**  
   View, edit, or delete users and see all orders placed.

---

## ⚙️ Installation Guide

### 📌 Requirements

- PHP 7.x or higher  
- Apache (XAMPP, WAMP, or LAMP)  
- MySQL  
- NodeMCU with RFID Module  
- Arduino IDE (for uploading ESP8266 code)

---

### 🚀 Setup Instructions

1. **Clone or Download the Repository**
   ```bash
   git clone https://github.com/yourusername/cashless-canteen-system.git
````

2. **Import the Database**

   * Open **phpMyAdmin**
   * Create a new database: `nodemcu_rfid_iot_projects`
   * Import `nodemcu_rfid_iot_projects.sql`

3. **Configure the Database Connection**

   * Open `database.php`
   * Set your DB credentials (host, user, password, dbname)

4. **Run the App**

   * Place the project in your web server directory:

     * For XAMPP: `htdocs/`
   * Open browser and visit:
     `http://localhost/cashless-canteen-system/index.html`

5. **Upload Arduino Code to NodeMCU**

   * Use Arduino IDE to upload RFID reading script (not included here)

---

## 🖼️ Screenshots

Add your screenshots in the `/img` folder and display them like:

```markdown
### 🔐 Login Page
![Login Page](img/login.png)

### 🧑‍🎓 User Dashboard
![User Dashboard](img/dashboard.png)

### 🧾 Receipt Example
![Receipt](img/receipt.png)
```

---

## 📌 Notes

* This project integrates PHP with NodeMCU using HTTP and real-time UID detection.
* The RFID UID is fetched via `UIDContainer.php` and inserted via `getUID.php`.
* Database credentials and table structure must match the provided SQL file.

---

## 📄 License

This project is licensed under the **MIT License**.
Feel free to modify and use it for educational or institutional purposes.

```
