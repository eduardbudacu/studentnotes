# Student Notes

The application allows students to organize their notes taken in the class or during individual study activities.

# Install 

```
git clone https://github.com/eduardbudacu/studentnotes.git
```

## Install frontend dependencies

```
cd frontend
npm install
```

## Install backend dependencies

```
cd backend
composer install
```

Create a local ```.env``` file and update database credentials

```
cp .env.example .env
```
Generate JWT secret

```
php artisan jwt:secret
```

Create database 

```
php artisan migrate:fresh
```

## Start application in development mode

```
cd frontend
npm start
```




