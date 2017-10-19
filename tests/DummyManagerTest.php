<?php

namespace Spatie\TranslationLoader\Test;

use Spatie\TranslationLoader\Test\TranslationManagers\DummyManager;

class DummyManagerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        $app['config']->set('translation-loader.translation_manager', DummyManager::class);
    }

    /** @test */
    public function it_allow_to_change_translation_manager()
    {
        $this->assertInstanceOf(DummyManager::class, $this->app['translation.loader']);
    }

    /** @test */
    public function it_can_translate_using_dummy_manager_using_file()
    {
        $this->assertEquals('en value', trans('file.key'));
    }

    /** @test */
    public function it_can_translate_using_dummy_manager_using_db()
    {
        $this->createLanguageLine('file', 'key', ['en' => 'en value from db']);
        $this->assertEquals('en value from db', trans('file.key'));
    }
}
