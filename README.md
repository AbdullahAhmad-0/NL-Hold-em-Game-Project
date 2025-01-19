# NL Hold'em Game Project

## Overview

Welcome to the **NL Hold'em Game Project**! This is a web-based poker game built using Laravel, where users can sign up, sign in, and enjoy the game of No-Limit Texas Hold'em. The project also includes an admin panel for managing users, levels, payments, and more.

For support, feel free to reach out via email: [abdullah.devloper@gmail.com](mailto:abdullah.devloper@gmail.com).

## GitHub Repository

You can access the project's GitHub repository here:

[https://github.com/AbdullahAhmad-0/NL-Hold-em-Game-Project.git](https://github.com/AbdullahAhmad-0/NL-Hold-em-Game-Project.git)

## Installation Steps

Follow these simple steps to set up the project on your local machine.

### Prerequisites

Make sure you have the following installed:

- PHP >= 7.4
- Composer
- MySQL Database
- Laravel (this project uses Laravel 8.x)

### Steps to Install

1. Clone the repository:
   git clone https://github.com/AbdullahAhmad-0/NL-Hold-em-Game-Project.git
   cd NL-Hold-em-Game-Project

2. Install the required dependencies using Composer:
   composer install

3. Duplicate the `.env.example` file and rename it to `.env`:
   cp .env.example .env

4. Configure your database credentials in the `.env` file:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password

5. Generate the application key:
   php artisan key:generate

6. Run database migrations to set up the required tables:
   php artisan migrate

8. Start the development server:
   php artisan serve

   Now your application should be running at [http://localhost:8000](http://localhost:8000).

## Routes

Here are the main routes for the game:

### User Routes
- **Login Page**: /game/sign-in
- **Sign-Up Page**: /game/sign-up
- **Select Account Page**: /game/select-account
- **Game Welcome Page**: /game/welcome
- **Main Game Page**: /game/main
- **User Profile Page**: /game/profile
- **Game History Page**: /game/game-history
- **Friends Page**: /game/friends
- **World Page**: /game/world
- **Store Page**: /game/store
- **Payment Page**: /game/payment
- **Payment History Page**: /game/payment-history
- **Conversion Page**: /game/conversion
- **Withdraw Page**: /game/withdraw
- **Withdraw History Page**: /game/withdraw-history
- **Chat Page**: /game/chat/{id} (replace `{id}` with the specific chat ID)
- **Select Table Page**: /game/select-table
- **NL Hold'em Game**: /game/nl-holdem
- **Played Page**: /game/played
- **Player Rank Page**: /game/player-rank
- **Logout**: /game/logout

### Admin Routes
- **Admin Login**: /login_admin
- **Admin Dashboard**: /admin
- **Manage Users**: /admin/users
- **Delete User**: /admin/users/delete/{id}
- **Verify User Email**: /admin/users/email-verify/{id}
- **View User**: /admin/users/view/{id}
- **Manage Levels**: /admin/levels
- **Delete Level**: /admin/levels/delete/{id}
- **View Level**: /admin/levels/view/{id}
- **Edit Level**: /admin/levels/edit/{id}
- **Add Level**: /admin/levels/add
- **Manage Payments**: /admin/payments
- **Approve Payment**: /admin/payments/approve/{id}
- **View Payment**: /admin/payments/view/{id}
- **Player Rake**: /admin/player_rake
- **Delete Player Rake**: /admin/player_rake/delete/{id}
- **Payment Withdrawals**: /admin/payment_withdraw
- **Approve Payment Withdrawal**: /admin/payment_withdraw/approve/{id}
- **Manage Payment Methods**: /admin/payment_methods
- **Delete Payment Method**: /admin/payment_methods/delete/{id}
- **Approve Payment Method**: /admin/payment_methods/approve/{id}
- **View Payment Method**: /admin/payment_methods/view/{id}
- **Add Payment Method**: /admin/payment_methods/add
- **Edit Payment Method**: /admin/payment_methods/edit/{id}
- **Admin Account Settings**: /admin/account
- **Logout**: /logout

## Contributing

If you would like to contribute to this project, feel free to open an issue or submit a pull request. Contributions are always welcome!

## License

This project is open source and available under the [MIT License](LICENSE).

## Contact

For any issues or support, you can contact us via email at [abdullah.devloper@gmail.com](mailto:abdullah.devloper@gmail.com).
