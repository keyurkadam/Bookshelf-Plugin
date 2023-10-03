<?php

namespace keyurkadam\crafttestplugin;

use Craft;
use craft\base\Plugin as BasePlugin;
use yii\base\Event;
use craft\events\RegisterCpNavItemsEvent;
use craft\web\twig\variables\Cp;
use keyurkadam\crafttestplugin\variables\BookshelfVariable;
use craft\web\twig\variables\CraftVariable;
use yii\base\Behavior;
/**
 * test-plugin plugin
 *
 * @method static Plugin getInstance()
 */
class Plugin extends BasePlugin
{
    public string $schemaVersion = '1.0.0';

    public static function config(): array
    {
        return [
            'components' => [
               
            ],
        ];
    }


    /**
     * Intialize the plugin.
     */
    public function init(): void
    {
        parent::init();   
        // Declare a variable for employing a frontend plugin
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event){
                
                $event->sender->set('bookshelf', BookshelfVariable::class);
            }
        );
        // Declare a variable for employing a frontend plugin
        Event::on(
            Cp::class,
            Cp::EVENT_REGISTER_CP_NAV_ITEMS,
            function (RegisterCpNavItemsEvent $event){
                $event->navItems[] = [
                    'url' => 'crafttestplugin',
                    'label' => 'Bookshelf',
                ];
            }
        );
        // Register a custom navigation item for the Craft CMS control panel.
        Event::on(
            \craft\web\UrlManager::class,
            \craft\web\UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (\craft\events\RegisterUrlRulesEvent $event) {
                $event->rules['bookshelf/book/web-add'] = '_test-plugin/book/webadd';
            }
            
        );
        
        // Register custom URL rules for routing within the Craft CMS control panel.
        Event::on(
            \craft\web\UrlManager::class,
            \craft\web\UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function (\craft\events\RegisterUrlRulesEvent $event) {
                $event->rules['crafttestplugin'] = '_test-plugin/book/index';
                $event->rules['bookshelf'] = '_test-plugin/book/index';
                
                $event->rules['bookshelf/book/add'] = '_test-plugin/book/add';
                $event->rules['bookshelf/save-book'] = '_test-plugin/book/add';

                
                $event->rules['bookshelf/book/delete/<id:\d+>'] = '_test-plugin/book/delete';
                $event->rules['bookshelf/book/edit/<id:\d+>'] = '_test-plugin/book/edit';
            }
            
        );
    }

    private function attachEventHandlers(): void
    {
        
    }
}
