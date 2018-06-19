<?php
/**
 * @author      Anand Siddharth <anandsiddharth21@gmail.com>
 * @copyright   Copyright (c) Anand Siddharth
 * @license     http://mit-license.org/
 *
 * @link        https://github.com/schedula/league-oauth2-social
 */

namespace OAuth2ServerExamples\Repositories;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use OAuth2ServerExamples\Entities\UserEntity;
use Schedula\League\OAuth2\Server\Repositories\UserSocialRepositoryInterface;

class UserSocialRepository implements UserSocialRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getUserEntityByUserCredentials(
        $username,
        $password,
        $grantType,
        ClientEntityInterface $clientEntity
    ) {
        // no use
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserFromSocialProvider(
        $accessToken,
        $provider,
        $grantType,
        ClientEntityInterface $clientEntity
    ) {
        if (true) { // your logic to verify from social auth provider and return user entity
            return new UserEntity();
        }

        return;
    }
}
