# Metro Commuter Rail Project

## How to Run the Metro Commuter Rail Project

### Prerequisites

- Ensure you have [XAMPP](https://www.apachefriends.org/index.html) installed on your machine.
- Ensure you have a Daraja account. You can sign up [here](https://developer.safaricom.co.ke/).
- Create an app in the Daraja sandbox to get your `consumerKey`, `consumerSecret`, and `passkey`.

### Steps to Set Up the Project

1. **Download the ZIP File**
   - Download the project zip file from the provided source.

2. **Extract the File**
   - Extract the zip file and copy the `metropass` folder.

3. **Paste Inside Root Directory**
   - Paste the `metropass` folder inside the root directory. For XAMPP, this is `xampp/htdocs`.

4. **Set Up the Database**
   - Open [PHPMyAdmin](http://localhost/phpmyadmin) in your web browser.
   - Create a new database with the name `rpmsdb`.
   - Import the `rpmsdb.sql` file, which is located inside the SQL file folder in the extracted zip package.

5. **Run the Application**
   - Open your web browser and run the script by navigating to [http://localhost/metropass/metropass](http://localhost/metropass/metropass).

### M-PESA Integration

1. **Daraja Account Setup**
   - Ensure you have a Daraja account.
   - Create an app in the Daraja sandbox environment.

2. **Generate Required Keys**
   - Obtain the `consumerKey`, `consumerSecret`, and `passkey` from the Daraja app you created.

3. **Running the M-PESA Integration**
   - To test the M-PESA integration, open your web browser and navigate to [http://localhost/metropass/metropass/mpesa/](http://localhost/metropass/metropass/mpesa/).

### Test Credentials

- Already created pass number: `305788314`

### Notes

- Ensure the callback URL for the M-PESA STK Push is publicly accessible if you're testing in a live environment.
- Update the `callbackurl` in your M-PESA script to point to your live server's URL when moving to production.
