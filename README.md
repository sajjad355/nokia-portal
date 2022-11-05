# CPP Fonesafe Application

#Setup and Installation:

Please check the official laravel installation guide for server requirements before you start. Official Documentation link

```
https://laravel.com/docs/8.x/installation#server-requirements
```

#Clone the repository

```
git clone https://gitlab.com/ShoebKafi/cpp-fonesafe.git
```

#Switch to the repo folder

```
cd cpp-fonesafe
```

#Install all the dependencies using composer

```
composer install
```

#Copy the example env file and make the required configuration changes in the .env file

```
cp .env.example .env
```

#Generate a new application key(optional)

```
php artisan key:generate
```

#Run the database migrations (Set the database connection in .env before migrating)

```
php artisan migrate
```

OR

#you can simply import the database(find the dump file from the below path) 

```
./database/cpp_fonesafe-15June2020.sql
```

#Add recaptcha validation

Just go to the following path: `cpp-fonesafe\vendor\laravel\ui\auth-backend\`
Open `AuthenticatesUsers.php` and go to `validateLogin()` function. Add below code in this method.
Add `use App\Rules\Captcha;` before start of the class.

```
'g-recaptcha-response'=> new Captcha(),
```
#Run the project

```
localhost/cpp-fonesafe/public/
```
#If getting exception after run the project, simply run the below command

```
composer update
```
```
composer dump-autoload
```
```
php artisan config:clear
```
```
php artisan cache:clear
```
```
php artisan view:clear
```
```
php artisan view:cache
```
