# Lumen Repository Pattern
Sample Repository Pattern for Lumen

#Events

`CreateUser` trigger when define new user in application

#Notification

`WelcomeUserNotification` send welcome message to new user

# routes

* `GET` `{host}/admin/users` fetch users list
* `GET` `{host}/admin/users/{userId}` receive a user details
* `POST` `{host}/admin/users`  create new user
* `POST` `{host}/admin/users/{userId}/update`  update user
* `POST` `{host}/admin/users/{userId}/delete` delete user


# install

* `composer install`
* `php artisan migrate`
* `php artisan db:seed`