## Summary
Earn TRON Wall aka ETW is a Mobile Friendly platform where Users can earn Free TRX by completing tasks from integrated Ad Networks
## Demo
Project is live at https://www.earntronwall.com
## Transactions
All transactions are now processed automatically
Mainnet Address (Tronscan) https://tronscan.org/#/address/TW7kxWkc8mzkNYMxAaxtdTYiL1AffF7iK8
## Roadmap
* ~~Automating transactions~~
* Advertising
* Application on Google Play
* Application on App Store
* Integrating more Ad Networks
* Partnering with Direct Advertisers
## Installation
Create new database
```
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `trx` varchar(100) NOT NULL,
  `wallet` varchar(500) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;			




CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(100) NOT NULL,
  `wallet` varchar(300) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `ref` varchar(100) NOT NULL,
  `points` varchar(100) NOT NULL,
  `offers` varchar(100) NOT NULL,
  `refearned` varchar(100) NOT NULL,    
  `offerids` TEXT NOT NULL       
) ENGINE=InnoDB DEFAULT CHARSET=latin1;			

```
Edit MySQL connection details in `dbcon.php`, `server.php` and `postbacks/global.php`

Replace YOURID in `ogwall.php` `Line 68` With your own Affiliate ID  

Replace Links to Offer Walls in `dashboard.php`  `Line 254` With your own

Setup Postback URLs in Ad Networks to Credit Users