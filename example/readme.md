# Example implementations

## Installation

0. Run `composer install` in this directory to install dependencies
0. Create a private key `openssl genrsa -out private.key 2048`
0. Create a public key `openssl rsa -in private.key -pubout > public.key`
0. `cd` into the public directory
0. Start a PHP server `php -S localhost:4444`

## Testing the social grant example

Send the following cURL request:

```
curl -X "POST" "http://localhost:4444/social.php/access_token" \
	-H "Content-Type: application/x-www-form-urlencoded" \
	-H "Accept: 1.0" \
	--data-urlencode "grant_type=social" \
	--data-urlencode "client_id=myawesomeapp" \
	--data-urlencode "client_secret=abc123" \
	--data-urlencode "accessToken=AccessTokenFromProvider" \
	--data-urlencode "provider=YourOauthProvider" \
	--data-urlencode "scope=basic email"
```
