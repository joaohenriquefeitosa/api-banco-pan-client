<?php

namespace Pan;

use Exception;
use http\Exception\InvalidArgumentException;
use Pan\Auth\Authentication;
use Pan\Auth\Credential;
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
     * @var Credential
     */
    private $credential;

    /**
     * Client constructor.
     *
     * @param string $apiKey
     *
     * @throws \Exception
     */
    public function __construct(string $apiKey)
    {
        $this->authentication = new Authentication();
        $this->covenants = new Covenants();
        $this->institutionalAffiliates = new InstitutionalAffiliates();
        $this->institutionalBodies = new InstitutionalBodies();
        $this->releaseMedium = new ReleaseMedium();
        $this->users = new Users();
        $this->proposal = new Proposal();
        $this->credential = new Credential($apiKey);
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws Exception
     */
    public function authenticate(...$args) : Response
    {
        if (empty($args) or sizeof($args) != 2) {
            throw new InvalidArgumentException("Missing Parameters");
        }

        $this->credential->setUsername($args[0]);
        $this->credential->setPassword($args[1]);

        $result = $this->authentication->authenticate($this->credential, $args);

        $token = $result->getContent()["access_token"];

        $this->credential->setAccessToken($token);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws Exception
     */
    public function covenants(...$args) : Response
    {
        if (empty($args) or sizeof($args) != 1) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->covenants->list($this->credential, $args);

        return $result;
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function institutionalAffiliates(): Response
    {
        if (!$this->isAuthenticated()) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->institutionalAffiliates->list($this->credential);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws Exception
     */
    public function institutionalBodies(...$args): Response
    {
        if (empty($args) or sizeof($args) != 1) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->institutionalBodies->list($this->credential, $args);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws Exception
     */
    public function releaseMedium(...$args): Response
    {
        if (empty($args) or sizeof($args) != 4) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->releaseMedium->list($this->credential, $args);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws Exception
     */
    public function users(...$args) : Response
    {
        if (empty($args) or sizeof($args) != 1) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new Exception('Need to authenticate');
        }

        $result = $this->users->list($this->credential, $args);

        return $result;
    }

    /**
     * @param array $args
     *
     * @return Response
     * @throws Exception
     */
    public function simulateProposal(...$args) : Response
    {
        if (empty($args) or sizeof($args) != 16) {
            throw new InvalidArgumentException("Missing Parameters");
        }
        if (!$this->isAuthenticated()) {
            throw new Exception('Need to authenticate');
        }

        return $this->proposal->simulate($this->credential, $args);
    }

    /**
     * @return bool
     */
    private function isAuthenticated()
    {
        return !empty($this->credential) and !empty($this->credential->getAccessToken());
    }

    /**
     * @param Authentication $authentication
     */
    public function setAuthentication(Authentication $authentication): void
    {
        $this->authentication = $authentication;
    }

    /**
     * @param Covenants $covenants
     */
    public function setCovenants(Covenants $covenants): void
    {
        $this->covenants = $covenants;
    }

    /**
     * @param InstitutionalAffiliates $institutionalAffiliates
     */
    public function setInstitutionalAffiliates(InstitutionalAffiliates $institutionalAffiliates): void
    {
        $this->institutionalAffiliates = $institutionalAffiliates;
    }

    /**
     * @param InstitutionalBodies $institutionalBodies
     */
    public function setInstitutionalBodies(InstitutionalBodies $institutionalBodies): void
    {
        $this->institutionalBodies = $institutionalBodies;
    }

    /**
     * @param ReleaseMedium $releaseMedium
     */
    public function setReleaseMedium(ReleaseMedium $releaseMedium): void
    {
        $this->releaseMedium = $releaseMedium;
    }

    /**
     * @param Users $users
     */
    public function setUsers(Users $users): void
    {
        $this->users = $users;
    }

    /**
     * @param Proposal $proposal
     */
    public function setProposal(Proposal $proposal): void
    {
        $this->proposal = $proposal;
    }

    /**
     * @param Credential $credential
     */
    public function setCredential(Credential $credential): void
    {
        $this->credential = $credential;
    }
}