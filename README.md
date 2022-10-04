# TimberHub

##Back-end 

Back-end API using Laravel;
- TechStacks: Laravel `9` and `Postgresql14` 
- web routes disabled
- Authentication disabled
- Add product.
- Product specifications and dimensions.
- Product suppliers.
- Product request form validation.
- Load file config.
- Seeders / factory.

## How tos;
- Change database details in the `.env` file.
- Run commands;
- `composer install` or `composer update`
- `cp .env.example .env` and change the database details, demo made using postgresql14
- `php artisan demo:install` which will run migration and seeders / factory.
- `php artisan serve`

##Licenses
-MIT

##Author
- Saddam UWEJAN
- saddamuwejan@gmail.com


##Front-end

Front-end consuming API from Laravel;
- TechStacks: NuxtJS, Vuex, Bootstrap-vue, Axios.
- Server side render SSR mode enabled.
- index page, will fetch demo products, and update up-on new products creation.
- Add product with server side validation.
- Add product with client side validation.
- Add product with static client side validation.
- Show form request body next to each form.
- Show toast messages on API calls.
- Minimal usage of external packages.

## How tos;
```bash
# install dependencies
$ npm install

# serve with hot reload at localhost:3000
$ npm run dev

# build for production and launch server
$ npm run build
$ npm run start

# generate static project
$ npm run generate
```


##Licenses
-MIT

##Author
- Saddam UWEJAN
- saddamuwejan@gmail.com

