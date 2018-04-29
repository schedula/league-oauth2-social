# The missing social authentication for [Php Oauth2 Server](https://github.com/thephpleague/oauth2-server)

Description : This package extends [thephpleague/oauth2-server](https://github.com/thephpleague/oauth2-server) for authorization of user via their social account via api. All you need to do is enable `SocialGrant` on your [`AuhtorizationServer`](https://github.com/thephpleague/oauth2-server/blob/master/src/AuthorizationServer.php) class.

_Note: This package is just an experiment, Everyone is inivited to contribute and make it better. For suggestions, queries or any type of conversation , please ping on gitter._

_Note: This package doesn't implement logic for authorizing with social identity provider that has to be written by developer. by Implementing `UserSocialRepositoryInterface`. Refer example for more_
