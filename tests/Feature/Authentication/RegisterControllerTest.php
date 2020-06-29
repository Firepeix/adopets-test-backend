<?php


namespace Tests\Feature\Authentication;


use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    public function testRegisterSuccess()
    {
        $user = ['name' => $this->faker->name, 'password' => 'secret', 'email' => $this->faker->companyEmail];
        $request = $this->json('POST', $this->getUri() . '/auth/register', $user);
        $request->assertStatus(200);
        unset($user['password']);
        $this->assertDatabaseHas('users', $user);
    }

    public function testRegisterInvalidRequest()
    {
        $user = ['name' => 'John Doe', 'password' => 'secret', 'email' => 'johnDoe@test.com'];
        foreach ($user as $attribute => $value) {
            $request = $this->json('POST', $this->getUri() . '/auth/register', [$attribute => $value]);
            $request->assertStatus(422);
        }
    }
}
