<?php
/**
 * Social grant.
 *
 * @author      Anand Siddharth <anandsiddharth21@gmail.com>
 * @copyright   Copyright (c) Anand Siddharth
 * @license     http://mit-license.org/
 *
 * @link        https://github.com/schedula/league-oauth2-social
 */
namespace Schedula\League\OAuth2\Server\Grant;

use League\OAuth2\Server\Grant\AbstractGrant;
use League\OAuth2\Server\ResponseTypes\ResponseTypeInterface;
use Psr\Http\Message\ServerRequestInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use League\OAuth2\Server\RequestEvent;
use Schedula\League\OAuth2\Server\Repositories\UserSocialRepositoryInterface;
/**
 * Social grant class.
 */

class SocialGrant extends AbstractGrant {
	/**
	* @param UserRepositoryInterface         $userRepository
	* @param RefreshTokenRepositoryInterface $refreshTokenRepository
	*/
	public function __construct(
		UserSocialRepositoryInterface $userRepository,
		RefreshTokenRepositoryInterface $refreshTokenRepository
	) {
		$this->setUserRepository($userRepository);
		$this->setRefreshTokenRepository($refreshTokenRepository);

		$this->refreshTokenTTL = new \DateInterval('P1M');
	}
	
	/**
	* {@inheritdoc}
	*/
	public function respondToAccessTokenRequest(
		ServerRequestInterface $request,
		ResponseTypeInterface $responseType,
		\DateInterval $accessTokenTTL
	) {
		// Validate request
		$client = $this->validateClient($request);
		$scopes = $this->validateScopes($this->getRequestParameter('scope', $request, $this->defaultScope));
		$user = $this->validateUser($request, $client);

		// Finalize the requested scopes
		$finalizedScopes = $this->scopeRepository->finalizeScopes($scopes, $this->getIdentifier(), $client, $user->getIdentifier());

		// Issue and persist new tokens
		$accessToken = $this->issueAccessToken($accessTokenTTL, $client, $user->getIdentifier(), $finalizedScopes);
		$refreshToken = $this->issueRefreshToken($accessToken);

		// Inject tokens into response
		$responseType->setAccessToken($accessToken);
		$responseType->setRefreshToken($refreshToken);

		return $responseType;
	}

	    /**
     * @param ServerRequestInterface $request
     * @param ClientEntityInterface  $client
     *
     * @throws OAuthServerException
     *
     * @return UserEntityInterface
     */
	protected function validateUser(ServerRequestInterface $request, ClientEntityInterface $client)
	{
		$accessToken = $this->getRequestParameter('accessToken', $request);
		if (is_null($accessToken)) {
		  throw OAuthServerException::invalidRequest('accessToken');
		}

		$provider = $this->getRequestParameter('provider', $request);
		if (is_null($provider)) {
		  throw OAuthServerException::invalidRequest('provider');
		}

		$user = $this->userRepository->getUserFromSocialProvider(
		  $accessToken,
		  $provider,
		  $this->getIdentifier(),
		  $client
		);
		if ($user instanceof UserEntityInterface === false) {
		  $this->getEmitter()->emit(new RequestEvent(RequestEvent::USER_AUTHENTICATION_FAILED, $request));

		  throw OAuthServerException::invalidCredentials();
		}

		return $user;
	}


	/**
	* {@inheritdoc}
	*/
	public function getIdentifier()
	{
		return 'social';
	}
}
