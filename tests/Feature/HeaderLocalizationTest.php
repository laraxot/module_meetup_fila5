<?php

declare(strict_types=1);

namespace Modules\Meetup\Tests\Feature;

use Modules\Meetup\Tests\TestCase;

uses(TestCase::class);

test('header navigation shows localized auth labels for german', function () {
    $response = $this->get('/de');
    $response->assertStatus(200);
    
    // Debug: save output if it fails
    if (!str_contains($response->getContent(), 'Einloggen')) {
        file_put_contents(base_path('test_output_de.html'), $response->getContent());
    }
    
    $response->assertSee('Einloggen')
        ->assertSee('Registrieren');
});

test('header navigation shows localized auth labels for english', function () {
    $this->get('/en')
        ->assertStatus(200)
        ->assertSee('Log in')
        ->assertSee('Sign up');
});

test('header navigation shows localized auth labels for italian', function () {
    $this->get('/it')
        ->assertStatus(200)
        ->assertSee('Accedi')
        ->assertSee('Registrati');
});

test('header navigation shows localized auth labels for french', function () {
    $this->get('/fr')
        ->assertStatus(200)
        ->assertSee('Se connecter')
        ->assertSee('S\'inscrire');
});

test('header navigation shows localized auth labels for spanish', function () {
    $this->get('/es')
        ->assertStatus(200)
        ->assertSee('Iniciar sesión')
        ->assertSee('Registrarse');
});

test('header navigation shows localized auth labels for russian', function () {
    $this->get('/ru')
        ->assertStatus(200)
        ->assertSee('Войти')
        ->assertSee('Регистрация');
});
