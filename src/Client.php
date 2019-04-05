<?php

namespace Pan;

use Pan\Auth\Authentication;
use Pan\Auth\Credential;
use Pan\Exceptions\InvalidArgumentException;
use Pan\Exceptions\UnautorizedException;
use Pan\Resource\Covenants;
use Pan\Resource\InstitutionalAffiliates;
use Pan\Resource\InstitutionalBodies;
use Pan\Resource\ReleaseMedium;
use Pan\Resource\Proposal;
use Pan\Resource\Users;

/**
 * Client
 */
class Client
{
    /**
     * @var Authentication
     */
    private $authentication;

    /**
     * @var Covenants
     */
    private $covenants;

    /**
     * @var InstitutionalAffiliates
     */
    private $institutionalAffiliates;

    /**
     * @var InstitutionalBodies
     */
    private $institutionalBodies;

    /**
     * @var ReleaseMedium
     */
    private $releaseMedium;

    /**
     * @var Users
     */
    private $users;

    /**
     * @var Proposal
     */
    private $proposal;

    /**
     * @var array
     */
    private $config;

    /**
     * Client constructor.
     *
     * @param string $apiKey
     * @param string $baseApiPath
     *
     * @throws \Exception
     */
    public function __construct(string $apiKey, string $baseApiPath)
    {
        if (empty($apiKey) or empty($baseApiPath)) {
            throw new InvalidArgumentException("Missing Parameters");
        }

        $this->authentication = new Authentication();
        $this->covenants = new Covenants();
        $this->institutionalAffiliates = new InstitutionalAffiliates();
        $this->institutionalBodies = new InstitutionalBodies();
        $this->releaseMedium = new ReleaseMedium();
        $this->users = new Users();
        $this->proposal = new Proposal();

        $this->config = [
            '$baseApiPath' => $baseApiPath,
            'credential' => new Credential($apiKey)
        ];
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws \Exception
     */
    public function authenticate(...$args) : Response
    {
        if (empty($args) or sizeof($args) != 2) {
            throw new InvalidArgumentException("Missing Parameters");
        }

        $this->config['credential']->setUsername($args[0]);
        $this->config['credential']->setPassword($args[1]);

        $result = $this->authentication->authenticate($this->config, $args);

        $token = $result->getContent()["access_token"];

        $this->config['credential']->setAccessToken($token);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws \Exception
     */
    public function covenants(...$args) : Response
    {
        if (empty($args) or sizeof($args) != 1) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new UnautorizedException("Need to authenticate");
        }

        $result = $this->covenants->list($this->config, $args);

        return $result;
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function institutionalAffiliates(): Response
    {
        if (!$this->isAuthenticated()) {
            throw new UnautorizedException("Need to authenticate");
        }

        $result = $this->institutionalAffiliates->list($this->config);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws \Exception
     */
    public function institutionalBodies(...$args): Response
    {
        if (empty($args) or sizeof($args) != 1) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new UnautorizedException("Need to authenticate");
        }

        $result = $this->institutionalBodies->list($this->config, $args);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws \Exception
     */
    public function releaseMedium(...$args): Response
    {
        if (empty($args) or sizeof($args) != 4) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new UnautorizedException("Need to authenticate");
        }

        $result = $this->releaseMedium->list($this->config, $args);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws \Exception
     */
    public function users(...$args) : Response
    {
        if (empty($args) or sizeof($args) != 1) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new UnautorizedException("Need to authenticate");
        }

        $result = $this->users->list($this->config, $args);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws \Exception
     */
    public function simulateProposal(...$args) : Response
    {
        if (empty($args) or sizeof($args) != 16) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new UnautorizedException("Need to authenticate");
        }

        return $this->proposal->simulate($this->config, $args);
    }

    /**
     * @return bool
     */
    private function isAuthenticated()
    {
        if (!isset($this->config['credential']))
            return false;

        $username = $this->config['credential']->getUsername();
        $password = $this->config['credential']->getPassword();

        return !empty($username) and !empty($password);
    }

    /**
     * @param Authentication $authentication
     *
     * @codeCoverageIgnore
     */
    public function setAuthentication(Authentication $authentication): void
    {
        $this->authentication = $authentication;
    }

    /**
     * @param Covenants $covenants
     *
     * @codeCoverageIgnore
     */
    public function setCovenants(Covenants $covenants): void
    {
        $this->covenants = $covenants;
    }

    /**
     * @param InstitutionalAffiliates $institutionalAffiliates
     *
     * @codeCoverageIgnore
     */
    public function setInstitutionalAffiliates(InstitutionalAffiliates $institutionalAffiliates): void
    {
        $this->institutionalAffiliates = $institutionalAffiliates;
    }

    /**
     * @param InstitutionalBodies $institutionalBodies
     *
     * @codeCoverageIgnore
     */
    public function setInstitutionalBodies(InstitutionalBodies $institutionalBodies): void
    {
        $this->institutionalBodies = $institutionalBodies;
    }

    /**
     * @param ReleaseMedium $releaseMedium
     *
     * @codeCoverageIgnore
     */
    public function setReleaseMedium(ReleaseMedium $releaseMedium): void
    {
        $this->releaseMedium = $releaseMedium;
    }

    /**
     * @param Users $users
     *
     * @codeCoverageIgnore
     */
    public function setUsers(Users $users): void
    {
        $this->users = $users;
    }

    /**
     * @param Proposal $proposal
     *
     * @codeCoverageIgnore
     */
    public function setProposal(Proposal $proposal): void
    {
        $this->proposal = $proposal;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config): void
    {
        $this->config = $config;
    }
}