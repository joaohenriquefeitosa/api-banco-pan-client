<?php


use Pan\Auth\Authentication;
use Pan\Auth\Credential;
use Pan\Client;
use Pan\Resource\Covenants;
use Pan\Resource\InstitutionalAffiliates;
use Pan\Resource\InstitutionalBodies;
use Pan\Resource\ReleaseMedium;
use Pan\Resource\Proposal;
use Pan\Resource\Users;
use Pan\Response;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $this->client = new Client('Api-Key');

        $credential = new Credential('Api-Key');
        $credential->setUsername('username');
        $credential->setPassword('password');
        $credential->setAccessToken('token');

        $this->client->setCredential($credential);
    }

    public function testAuthenticationShouldReturnResultObject()
    {
        $authentication = $this
            ->getMockBuilder(Authentication::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response = new Response();
        $response->setContent([
           'access_token' => 'token'
        ]);

        $authentication
            ->method('authenticate')
            ->willReturn($response);

        $this->client->setAuthentication($authentication);
        $result = $this->client->authenticate('','');

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testCovenantsShouldReturnResultObject()
    {
        $covenants = $this
            ->getMockBuilder(Covenants::class)
            ->disableOriginalConstructor()
            ->getMock();

        $covenants
            ->method('list')
            ->willReturn(new Response());

        $this->client->setCovenants($covenants);
        $result = $this->client->covenants('');

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testInstitutionalAffiliatesShouldReturnResultObject()
    {
        $institutionalAffiliates = $this
            ->getMockBuilder(InstitutionalAffiliates::class)
            ->disableOriginalConstructor()
            ->getMock();

        $institutionalAffiliates
            ->method('list')
            ->willReturn(new Response());

        $this->client->setInstitutionalAffiliates($institutionalAffiliates);
        $result = $this->client->institutionalAffiliates();

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testInstitutionalBodiesShouldReturnResultObject()
    {
        $institutionalBodies = $this
            ->getMockBuilder(InstitutionalBodies::class)
            ->disableOriginalConstructor()
            ->getMock();

        $institutionalBodies
            ->method('list')
            ->willReturn(new Response());

        $this->client->setInstitutionalBodies($institutionalBodies);
        $result = $this->client->institutionalBodies(['']);

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testReleaseMediumShouldReturnResultObject()
    {
        $releaseMedium = $this
            ->getMockBuilder(ReleaseMedium::class)
            ->disableOriginalConstructor()
            ->getMock();

        $releaseMedium
            ->method('list')
            ->willReturn(new Response());

        $this->client->setReleaseMedium($releaseMedium);
        $result = $this->client->releaseMedium('','','','');

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testUsersShouldReturnResultObject()
    {
        $users = $this
            ->getMockBuilder(Users::class)
            ->disableOriginalConstructor()
            ->getMock();

        $users
            ->method('list')
            ->willReturn(new Response());

        $this->client->setUsers($users);
        $result = $this->client->users('');

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testSimulateProposalShouldReturnResultObject()
    {
        $proposal = $this
            ->getMockBuilder(Proposal::class)
            ->disableOriginalConstructor()
            ->getMock();

        $proposal
            ->method('simulate')
            ->willReturn(new Response());

        $this->client->setProposal($proposal);
        $result = $this->client->simulateProposal('','','','','','','','','','','','','','','','');

        $this->assertInstanceOf(Response::class, $result);
    }
}
