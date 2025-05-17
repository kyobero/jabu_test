


✅ 1. Clone the Repository
git clone https://github.com/kyobero/jabu_test.git
cd repository

✅ 2. Install PHP Dependencies with Composer
composer install

✅ 3. Copy and Configure the Environment File

✅ 4. Generate Application Key
php artisan key:generate

✅ 5. Set Permissions optional (Linux/macOS)
sudo chmod -R 775 storage bootstrap/cache

✅ 6. Set Up the Database
php artisan migrate
php artisan db:seed

✅ 7. Serve the Application
php artisan serve
It will start the Laravel development server, usually at:
http://127.0.0.1:8000

✅ 8. Install Node Dependencies 
npm install
npm run dev   