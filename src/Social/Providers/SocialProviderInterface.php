<?php
/**
 * Social provider interface.
 *
 * @author      Anand Siddharth <anandsiddharth21@gmail.com>
 * @copyright   Copyright (c) Anand Siddharth
 * @license     http://mit-license.org/
 *
 * @link        https://github.com/anandsiddharth/league-oauth2-social
 */
namespace Anand\League\OAuth2\Server\Social\Providers;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;


interface SocialProviderInterface {

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

	public function getUserEntityBySocialProvider(
		$accessToken,
        $provider,
        $grantType,
        ClientEntityInterface $clientEntity
	);

}