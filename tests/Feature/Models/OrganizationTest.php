<?php

namespace Tests\Feature\Models;

use App\Models\Organization;
use App\Models\Province;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    use DatabaseTransactions;

    protected Organization $organization;

    public function setUp(): void
    {
        parent::setUp();
        $this->organization = Organization::factory()->create();
    }

    /**
     * @test
     */
    public function organization_must_have_one_province()
    {

        $this->assertEquals($this->organization->province_id, Province::where('id', '=', $this->organization->province_id)->value('id'));

    }

    /**
     * @test
     */
    public function organization_must_have_one_type()
    {

        // $this->assertDatabaseCount()
    }
}
