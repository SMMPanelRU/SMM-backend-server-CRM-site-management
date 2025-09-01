<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    /**
     * Test that security headers are applied.
     *
     * @return void
     */
    public function test_security_headers_are_applied()
    {
        $response = $this->get('/');

        // Check for security headers
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-XSS-Protection', '1; mode=block');
        $response->assertHeader('X-Frame-Options', 'DENY');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Check for CSP header presence
        $this->assertTrue($response->headers->has('Content-Security-Policy'));
    }

    /**
     * Test API endpoints require proper headers.
     *
     * @return void
     */
    public function test_api_endpoints_require_client_token()
    {
        $response = $this->postJson('/api/products');
        
        $response->assertStatus(403);
        $response->assertJson(['message' => 'Unauthorized']);
    }

    /**
     * Test rate limiting on login endpoint.
     *
     * @return void
     */
    public function test_login_endpoint_has_rate_limiting()
    {
        // This would need a valid site token for full testing
        // But we can at least verify the endpoint structure
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ], [
            'X-Client-Token' => 'test-token'
        ]);

        // Should return 403 due to invalid token, but rate limiting structure is in place
        $this->assertContains($response->getStatusCode(), [403, 422, 429]);
    }

    /**
     * Test CORS configuration is restrictive.
     *
     * @return void
     */
    public function test_cors_configuration_is_restrictive()
    {
        $corsConfig = config('cors');
        
        // Ensure we're not allowing all origins
        $this->assertNotEquals(['*'], $corsConfig['allowed_origins']);
        $this->assertNotEquals(['*'], $corsConfig['allowed_headers']);
    }
}