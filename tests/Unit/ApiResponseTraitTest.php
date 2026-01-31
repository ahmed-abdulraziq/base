<?php

namespace Tests\Unit;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ApiResponseTraitTest extends TestCase
{
    #[Test]
    public function success_returns_json_with_status_message_and_data(): void
    {
        $controller = new class extends Controller {
            use ApiResponseTrait;

            public function run(): JsonResponse
            {
                return $this->success('OK', ['id' => 1]);
            }
        };

        $response = $controller->run();
        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = $response->getData(true);
        $this->assertTrue($data['status']);
        $this->assertSame('OK', $data['message']);
        $this->assertSame(['id' => 1], $data['data']);
        $this->assertSame(200, $response->getStatusCode());
    }

    #[Test]
    public function error_returns_json_with_status_false_and_errors(): void
    {
        $controller = new class extends Controller {
            use ApiResponseTrait;

            public function run(): JsonResponse
            {
                return $this->error('Validation failed', ['email' => ['Invalid']]);
            }
        };

        $response = $controller->run();
        $data = $response->getData(true);
        $this->assertFalse($data['status']);
        $this->assertSame('Validation failed', $data['message']);
        $this->assertSame(['email' => ['Invalid']], $data['errors']);
        $this->assertSame(400, $response->getStatusCode());
    }

    #[Test]
    public function created_returns_201_with_message_and_data(): void
    {
        $controller = new class extends Controller {
            use ApiResponseTrait;

            public function run(): JsonResponse
            {
                return $this->created('Created', ['id' => 5]);
            }
        };

        $response = $controller->run();
        $this->assertSame(201, $response->getStatusCode());
        $data = $response->getData(true);
        $this->assertTrue($data['status']);
        $this->assertSame('Created', $data['message']);
        $this->assertSame(['id' => 5], $data['data']);
    }

    #[Test]
    public function not_found_returns_404(): void
    {
        $controller = new class extends Controller {
            use ApiResponseTrait;

            public function run(): JsonResponse
            {
                return $this->notFound('User not found');
            }
        };

        $response = $controller->run();
        $this->assertSame(404, $response->getStatusCode());
        $data = $response->getData(true);
        $this->assertFalse($data['status']);
        $this->assertSame('User not found', $data['message']);
    }

    #[Test]
    public function server_error_returns_500(): void
    {
        $controller = new class extends Controller {
            use ApiResponseTrait;

            public function run(): JsonResponse
            {
                return $this->serverError('Internal error');
            }
        };

        $response = $controller->run();
        $this->assertSame(500, $response->getStatusCode());
        $data = $response->getData(true);
        $this->assertFalse($data['status']);
        $this->assertSame('Internal error', $data['message']);
    }
}
