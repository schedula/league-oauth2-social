<?php
/**
 * User Social Repository interface.
 *
 * @author      Anand Siddharth <anandsiddharth21@gmail.com>
 * @copyright   Copyright (c) Anand Siddharth
 * @license     http://mit-license.org/
 *
 * @link        https://github.com/schedula/league-oauth2-social
 */
namespace Schedula\League\OAuth2\Server\Repositories;

use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;

interface UserSocialRepositoryInterface extends UserRepositoryInterface {

	/**
     * Get a user entity.
     *
     * @param string                $accessToken
     * @param string                $provider
     * @param string                $grantType    The grant type used
     * @param ClientEntityInterface $clientEntity
     *
     * @return UserEntityInterface
     */
	
	public function getUserFromSocialProvider(
		$accessToken,
        $provider,
        $grantType,
        ClientEntityInterface $clientEntity
	);

}