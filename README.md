# eCommerce Store

This project is an eCommerce store developed using PHP, HTML, CSS, JavaScript, jQuery, AJAX, Bootstrap, Font Awesome, and Google Fonts. The store allows users to browse products, add items to cart, place orders, and manage their accounts. Administrators can manage products, categories, orders, and users through the admin dashboard.

## Features

- **Product Catalog**: Browse and search products by category or keyword.
- **Shopping Cart**: Add, update, and remove items from the cart.
- **User Authentication**: Register, login, and manage user accounts.
- **Order Management**: Place orders, view order history, and track shipments.
- **Admin Dashboard**: Manage products, categories, orders, and users.
- **Responsive Design**: Optimized for desktop and mobile devices using Bootstrap.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript, jQuery, AJAX
  - **Libraries**: Bootstrap, Font Awesome, Google Fonts
- **Backend**: PHP
- **Database**: MySQL

### Project File Structure

```
ecommerce-store/
│
├── admin/
│   ├── manage_products.php
│   ├── manage_orders.php
│   ├── manage_users.php
│   ├── dashboard.php
│   ├── add_product.php
│   ├── edit_product.php
│   ├── delete_product.php
│   ├── ...
│
├── db-conn/
│   ├── config.php
│   ├── db.php
│   ├── functions.php
│
├── DB/
│   ├── ecommerce_db.sql
│
├── login/
│   ├── login.php
│   ├── register.php
│   ├── forgot_password.php
│   ├── reset_password.php
│   ├── ...
│
├── user/
│   ├── index.php
│   ├── profile.php
│   ├── cart.php
│   ├── checkout.php
│   ├── order_history.php
│   ├── ...
│
├── assets/
│   ├── css/
│   │   ├── styles.css
│   │   ├── bootstrap.min.css
│   ├── js/
│   │   ├── main.js
│   │   ├── jquery.min.js
│   │   ├── bootstrap.bundle.min.js
│   ├── img/
│   ├── fonts/
│
├── README.md
│
└── ...
```

## Setup Instructions

Follow these steps to set up the eCommerce Store on your local machine.

### Prerequisites

- **Web Server**: Apache or any web server of your choice.
- **PHP**: Version 7.0 or above.
- **MySQL**: Version 5.7 or above.
- **Browser**: A modern web browser like Chrome, Firefox, or Edge.

### Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/ecommerce-store.git
   cd ecommerce-store
   ```

2. **Move the project to your web server directory**:
   Move the project files to your web server's root directory (e.g., `htdocs` for XAMPP, `www` for WAMP, or `public_html` for a live server).

3. **Create a MySQL database**:
   Log in to your MySQL server and create a new database:
   ```sql
   CREATE DATABASE ecommerce_db;
   ```

4. **Import the database**:
   Import the provided SQL file (`ecommerce_db.sql`) located in the `DB` folder into your newly created database:
   ```bash
   mysql -u yourusername -p ecommerce_db < /path/to/DB/ecommerce_db.sql
   ```

5. **Configure the database connection**:
   Update the `db-conn/config.php` file with your database credentials:
   ```php
   <?php
   $servername = "localhost";
   $username = "yourusername";
   $password = "yourpassword";
   $dbname = "ecommerce_db";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   ?>
   ```

6. **Start the web server**:
   Ensure your web server and MySQL server are running.

7. **Access the application**:
   Open your web browser and go to `http://localhost/ecommerce-store/user/index.php` to access the user interface or `http://localhost/ecommerce-store/admin/dashboard.php` for the admin dashboard.

## Usage

- **Admin Dashboard**: Log in as an admin to manage products, orders, and users.
- **User Interface**: Register, log in, browse products, add items to cart, and complete orders.

## License

This project is licensed under the MIT License. See the `LICENSE` file for more details.

## Acknowledgements

- Thanks to Bootstrap, Font Awesome, Google Fonts, and other open-source libraries used in this project.

### Screenshots

- ![Screenshot 1](https://i.imgur.com/1vQkyAy.png)
- ![Screenshot 2](https://i.imgur.com/0i1gcS1.png)
- ![Screenshot 3](https://i.imgur.com/4sCeLlI.png)
- ![Screenshot 4](https://i.imgur.com/HSIUmUC.png)
- ![Screenshot 5](https://i.imgur.com/zsEBNtx.png)
