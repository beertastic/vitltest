# VITL test - Tristan Pretty

## Laravel Version: 6.0.3

### First steps

I didn't have time to make a docker image, so sadly you'll need to:

 1. Create a new DB called vitl (as Laravel migrations do not create databases, only tables)
 2. Edit the env file with your DB credentials
 3. Edit your server config to point to the public DIR
 4. Edit your hosts file to point to your test URL (I used vitl.local)


----------


Then we will need laravel migrations and seeds.

Assuming you've got composer installed.

Run these lines once you've cloned the repo:

```
composer install

php artisan migrate

php artisan db:seed
```

I had my htaccess file to ignore index.php.. as it standard.
But as .htaccess files are not typically uploaded to GIT, I've included what I have, in my email.

Buzz me if there are issues, BUT, uf you can see the form, but get network errors on the search, this is why.

Finally, visit your home page of the URL previously set up in the first steps in your hosts file etc


----------

## Points and notes

### Things I'm not happy with:

 - it's UGLY! I would have loved to have cleaned up the general 'prettiness' of it, but that wasn't the test and I'll be honest, I've been spoilt by jQuery and bootstrap. the requirement to only use pure JS slowed me down, but I really did enjoy the challenge as I started on pure JS 20 years ago.
 - I would have liked to add a count next to the duplicated results. letting the user know there there were 5 of this name etc. However, that would require a little more work than the time allowed and I just used simple Eloquent queries to fetch 'easy' results.
 - I feel that another checkbox allowing for wildcard searches (Using LIKE '%%' in MySQL would have been great. But I ran out of time. I feel like this would have been a great addition though.
 - I would have prefered to add error messages etc to a lang file.
 - My implemtation of messages to the user is not perfect/clean enough
 - Separating js/css to separate files is preferable, but kept them together for ease of use.


### Things of note:

 - I used a package to import the csv. I didn't write that, or have ever used it before, but it was a quick way to get started. Typically I do like to know what's going on under the hood when I know code will make its way to a prod server. I didn't examine this package in this instance though (https://packagist.org/packages/jeroenzwart/laravel-csv-seeder)
 - My god I missed jQuery
 - I would've preferred to have built a 'proper' micro-service Api. But speed and ease of use dictated that I use the WEB routes file. However, the code used would be 99% fine in either approach.
 - I added a search history table in my initial set up. I thought it could be used to help users go back over popular searches. I didn't really think it through fully, just a habit to keep track of data. It has potential, but yeah, while it does save search history.... it's useless in this demo :) 
