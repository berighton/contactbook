## Simple Contact Book

Contact book is a simple app written in Laravel as part of the technical assessment for a job interview. To compile, please run the following steps:

- Create GitHub app, obtain API keys
- Create Facebook app, obtain API keys
- Register for a trial account at ActiveCampaign and/or obtain API keys
- SSH into a local/dev server
- Install php, apache, mysql
- Create mysql database (**contactbook**), user and password
- Clone/upload project to the server
- Install composer and run _composer update_ (check to make sure that all of the required php extension are installed)
- Install nodejs version 8 (default node that comes with Ubuntu will not work as it is version 4; likewise the latest version 9+ will not work either)
- Copy **.env.example** config file and rename to **.env**. Update the values
- Run _php artisan migrate_
- Run _npm install_
- Run _npm run production_
- Configure apache virtual host to point to public project folder
- Enable mod_rewrite with _a2enmod rewrite_
- Restart apache service with _sudo service apache2 restart_
- Access the app via a pre-configured URL. [DEMO](http://ec2-18-218-192-236.us-east-2.compute.amazonaws.com)

## Author

Paul Brighton, Jan 2018
