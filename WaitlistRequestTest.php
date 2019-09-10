<?php

namespace Tests\Unit;

use App\Http\Requests\WaitlistRequest;
use Faker\Factory;
use Illuminate\Validation\Validator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WaitlistRequestTest extends TestCase {

    use RefreshDatabase;

    private $rules;

    private $validator;

    public function setUp(): void {
        parent::setUp();

        $this->validator = app()->get('validator');

        $this->rules = (new WaitlistRequest())->rules();
    }

    public function validationProvider() {
        /* WithFaker trait doesn't work in the dataProvider */
        $faker = Factory::create( Factory::DEFAULT_LOCALE);

        return [
            'request_should_fail_when_no_email_is_provided' => [
                'passed' => false,
                'data' => []
            ],
            'request_should_fail_when_email_format_is_wrong' => [
                'passed' => false,
                'data' => [
                    'email' => $faker->paragraph()
                ]
            ],
            'request_should_pass_when_data_is_provided' => [
                'passed' => true,
                'data' => [ 'email' => $faker->email ]
            ]
        ];
    }

    /**
     * @test
     * @dataProvider validationProvider
     * @param bool $shouldPass
     * @param array $mockedRequestData
     */
    public function it_validates_results_as_expected($shouldPass, $mockedRequestData) {
        $this->assertEquals(
            $shouldPass,
            $this->validate($mockedRequestData)
        );
    }

    protected function validate($mockedRequestData) {
        return $this->validator
            ->make($mockedRequestData, $this->rules)
            ->passes();
    }

}