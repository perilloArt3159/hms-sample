# HMS-SAMPLE

No Description.

## Table of contents

* [Contributors](#contributors)
* [Technologies](#technologies)
  * [General](#general)
  * [Composer Packages](#composer-packages)
  * [NPM Packages](#npm-packages)
* [Tools](#tools)
* [Project Setup](#project-setup)
  * [Back-End](#back-end)
  * [Front-End](#front-end)
* [License](#license)

## Contributors

|Name  |Role | Status      |
|:----:|:-----:|:------------------|
|[perilloArt3159](https://github.com/perilloArt3159)| Full-Stack | Active

## Technologies

### General

|Name  |Version | Description      |
|:----|:-----|:------------------|
| [Laravel](https://laravel.com/docs/9.x)     |`9.24.0`        |PHP Back-End Framework           |
| [MySQL](https://www.mysql.com/)             |`8.0.0`         |Relational Database Management System        |
| [TailwindCSS](https://tailwindcss.com/)     |`3.1.0`         | Utility-First CSS Library |
| [Nuxt.js](https://nuxtjs.org/)              |`2.15.8`        |Vue.js Open-Source Framework   |

### Composer Packages

|Name                                                                                                           |Version          |Description                                         |
|:---------------------------------------------------------------------------------------------                |:---------------:|:-------------------------------------------:       |
|[cviebrock/eloquent-sluggable](https://github.com/cviebrock/eloquent-sluggable)                                |`9.0.0`          |Generate Slugs for Eloquent Models                  |


### NPM Packages

|Name                                                                                                           |Version          |Description                                    |
|:--------------------------------------------------------------------------------:                             |:---------------:|:-------------------------------------------:  |
|[SASS](https://sass-lang.com/)                                                                                 |`1.54.4`         |CSS Preprocessor                               |
|[Bootstrap Icons](https://icons.getbootstrap.com)                                                              |`1.9.1`          |Open-source Icon Library                       |


## Tools

|Name                                                                                                           |Description                                         |
|:---------------------------------------------------------------------------------------------                |:-------------------------------------------       |
|[Diagrams.net](https://www.diagrams.net/)                                                                      |open source cross-platform graph drawing software   |
|[Insomnia API Client](https://insomnia.rest/)                                                                  |open source API client |

## Project Setup

### Back-End

* From the backend directory, install all the Composer Package Dependencies.

```bash
# Install Composer Package Dependencies
$ composer install
```

* Create a new file called `.env` then copy and paste the contents of `.env.example` or just run the following command.

```bash
# Copy .env.example to .env
$ cp .env.example .env
```

* In your `.env` file, if you disagree with the defaults, set up your correct parameters. Take note for the `DB_DATABASE` parameter, the database must be created prior in MySQL.

```bash
APP_NAME="Customer Management System"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hms_sample
DB_USERNAME=root
DB_PASSWORD=root
```

* Generate the `APP_KEY`.

```bash
# Command to Generate APP_KEY 
$ php artisan key:generate
```

* Run the Migrations and Seeders for the Database Tables and Seeders respectively for testing.

```bash
# Command to Migrate Tables
$ php artisan migrate:fresh 

# Command to Migrate Seeders
$ php artisan db:seed
```

* Start the Back-End Server.

```bash
# Command to Run the Server
$ php artisan serve 
```

* Import the [yaml file](https://github.com/perilloArt3159/hms-sample/blob/master/backend/docs/api/Insomnia_API.yaml) into your local Insomnia API Client located inside the `backend/docs/api` folder.

### Front-End

* From the Front-Directory, install all the NPM Package dDpendencies by running the following command.

```bash
# Install NPM Package Dependencies
$ npm install 
```

* Start the Front-End Server.

```bash
# Command to Run the Server
$ npm run dev
```

## License

Project is licensed under [MIT](https://mit-license.org/).
