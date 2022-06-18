# MENU TEST APP

This is a Exchange Rate Test App

## Installation

To install and run the project locally, please do the following:
- Step 1: Clone the project running the command: `git clone https://github.com/mb990/exchange-rate-app.git`
- Step 2: Run your local php server environment
- Step 3: Copy the content of the `.env.example` file from the root of the project to a newly created file named `.env` and save it in the root of the project as well
- Step 4: Run `composer install`
- Step 5: Run `npm install`
- Step 6: Run `npm run dev`
- Step 7: Run `php artisan key:generate`
- Step 8: Create a database with the name of your choice
- Step 9: Edit the .env file with the following changes:
    - `DB_DATABASE=name_of_your_created_database`
    - `DB_USERNAME=your_username`
    - `DB_PASSWORD=your_password`
    - `QUEUE_CONNECTION='database'` - we will be using database connection in this case
        - PLEASE SET YOUR MAILTRAP CONFIGURATION IN THE `.env` FILE, AS IT IS THE TEST SERVER WE WILL BE USING, INCLUDING THE FOLLOWING VARIABLES:
        - `MAIL_MAILER`
        - `MAIL_HOST`
        - `MAIL_PORT`
        - `MAIL_USERNAME`
        - `MAIL_PASSWORD`
        - `MAIL_ENCRYPTION`
    - `MAIL_FROM_ADDRESS="menu-test@example.com"`
    - `MAIL_TO_ADDRESS='your-address-of-choice@example.com'` NOTE: email will appear in Mailtrap inbox, this address will only be visible in a `To` header. Variable value must be a valid email, otherwise it won't be sent
    - `EXCHANGE_RATE_API_BASE_URL="https://api.apilayer.com/currency_data/live"`
    - `EXCHANGE_RATE_API_KEY="hBGu8TGps8CAbfYTfW2LKqzAGQkT9J2t"`
- Step 10: Run `php artisan optimize`
- Step 11: Run `php artisan config:clear`
- Step 12: Run `php artisan cache:clear`
- Step 13: Run `php artisan migrate --seed`
- Step 14: In order to use queues run `php artisan queue:work` in a separate terminal tab. NOTE: the tab must stay opened
- Step 15: Navigate to `http://localhost:your-chosen-port/` to use the app.
- Step 16: To change discount % for any currency stored in the database or to update exchange rates, go to the `/config` page.
