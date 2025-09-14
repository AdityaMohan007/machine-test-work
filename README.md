# Payment Gateway Integration 

## Instructions

1. Clone the project repository.
    ```
    https://github.com/AdityaMohan007/machine-test-app.git
    ```

2. Install dependencies.
    ```
    composer install
    
    npm install && npm run dev
    ```
    
3. Copy the .env.example to .env
    ```
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=payment_gateway_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4. Generate application key
    ```
    php artisan key:generate
    ```

5. Run migration and seed command to migrate payment table and seed user data.
    ```
    php artisan migrate

    php artisan db:seed
    ```

6. Run the Laravel development server and access project at http://localhost:8000
    ```
    php artisan serve
    ```

7. Login to use the payment gateway functionality using below credentials:
    ```
    mail: john@example.com
    pass: password
    ```

8. In the .env file, update the stripe keys. Refer url https://dashboard.stripe.com/test/apikeys
    ```
    STRIPE_PK=
    STRIPE_SK=
    ```

9. When checkout tab is clicked, checkout page is shown.
   
    <img width="1210" height="649" alt="image" src="https://github.com/user-attachments/assets/53ba2830-06ce-4038-8e7e-3b289c2125ad" />


10. When "Pay Now" button is clicked, it is redirected the payment gateway page (mastercard test card credentials used).
    
    <img width="1144" height="615" alt="image" src="https://github.com/user-attachments/assets/d3cfa0c2-a78d-415b-b089-19937e549641" />

    <img width="1142" height="612" alt="image" src="https://github.com/user-attachments/assets/932d98c4-8034-4698-8ac9-6f2ab3bcf01c" />


11. After payment is completed without errors, user is redirected to the success page with customer details and transaction ID.
    
    <img width="1201" height="644" alt="image" src="https://github.com/user-attachments/assets/c3b0ff3f-26f4-4113-8733-116474142732" />

 

    





