# MuddyBot

A simple web page to determine if it will be muddy 3 days from now. Based on [the Symfony PHP framework](https://symfony.com).

## Get up & running

```
git clone https://github.com/danseely/muddybot.git

cd muddybot/docker

docker-compose up
```

## Compose

### PHP (PHP-FPM)

Composer is included

```
docker-compose run php-fpm composer install
```

### Add API keys
You'll need an API key for the [Dark Sky API](https://darksky.net/dev/docs) and the [Google geocoding API](https://developers.google.com/maps/documentation/geocoding/start). You can create the file `.env.local` and add them to the bottom of the file like this:

```
GOOGLE_MAPS_API_KEY=<KEY_HERE>
DARK_SKY_API_KEY=<KEY_HERE>
```

## Usage

Visit http://localhost/weather and enter a zip code to see if it'll be muddy there 3 days from now.

## Run tests
```
docker-compose run php-fpm php bin/phpunit tests
```

# To Do
- [x] form for entering location
- [ ] make form async
- [ ] allow for entering either city or location
- [ ] sanitize input
- [ ] style page 🙈
- [ ] full docker wrapper
- [ ] better handling of API keys (they're not particularly secret)
- [ ] make the endpoint more generic, to handle other use cases
- [ ] deployment plan
- [ ] why so slow?

[_Docker + Symfony skeleton based off the work of Martin Pham here._](https://gitlab.com/martinpham/symfony-5-docker)

