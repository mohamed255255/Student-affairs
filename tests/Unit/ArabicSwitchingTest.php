<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArabicSwitchingTest extends TestCase
{

    public function testArabicLanguageSwitching()
    {
        // Simulate clicking the Languages button and choosing Arabic language
        $response = $this->get(route('languageConverter', 'ar'));
        // Assuming the redirection is to the same page means it is working
        $response->assertStatus(302);

        $currentLanguage = app()->getLocale();

        $translation = __('public.LANGUAGES', [], $currentLanguage);

        $this->assertEquals('اللغات', $translation);

    }

}
