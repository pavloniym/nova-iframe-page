# Nova Iframe Page Tool for Laravel Nova

This Laravel Nova package allows you to create pages with iframe content, making it easy to embed external websites or internal application pages within your Nova admin panel. The package is fully customizable, enabling you to adjust the iframe's appearance and behavior to suit your needs.

## Features

- **Customizable Iframe Source:** Set the source URL for the iframe content.
- **Adjustable Iframe Height:** Modify the height of the iframe to fit your layout.
- **Disable Scrolling:** Option to disable scrolling within the iframe.
- **Toggle Top Padding:** Control whether the iframe content has top padding.
- **Remove Iframe Border:** Option to remove the iframe's border for a cleaner look.
- **Border Radius:** Option to add or remove border radius around the iframe.
- **Custom Iframe Styles and Options:** Pass additional styles and options to the iframe.

## Requirements

- PHP 8.0 or higher
- Laravel 8.x, 9.x, or 10.x
- Laravel Nova 4.x

## Installation

You can install the package via Composer:

```bash
composer require pavloniym/nova-iframe-page
```

## Usage

### Registering the Routes

To register the routes for the iframe page, you need to modify your `NovaServiceProvider`. Add the following code to the `routes` method:

```php
use Pavloniym\NovaIframePage\NovaIframePage;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    // ...

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        // ...
        // default nova routes

        NovaIframePage::make()
            ->setSrc('https://mycoolsite.com')
            ->setPath('custom-iframe-path')
            ->register();
    }

    // ...
}
```


### Adding the Tool to the Sidebar Menu

To add the iframe page tool to the Nova sidebar menu, modify the `tools` method in your `NovaServiceProvider` as follows:

```php
use Pavloniym\NovaIframePage\NovaIframePage;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    // ...

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            NovaIframePage::make()
                ->setIcon('server')
                ->setName('My Cool Site')
                ->setPath('custom-iframe-path'),
        ];
    }

    // ...
}
```

### Customization Options

The package provides several methods to customize the iframe page:

#### 1. Set the Iframe Source

Set the URL of the page you want to display in the iframe.

```php
NovaIframePage::make()->setSrc('https://mycoolsite.com');
```

#### 2. Set the Height

You can adjust the height of the iframe using the `setHeight` method. The height can be any valid CSS height value.

```php
NovaIframePage::make()->setHeight('600px');
```

#### 3. Disable Scrolling

If you want to disable scrolling within the iframe, use the `setNoScroll` method.

```php
NovaIframePage::make()->setNoScroll(true);
```

#### 4. Disable Top Padding

To remove the default top padding of the iframe content, use the `setNoTopPadding` method.

```php
NovaIframePage::make()->setNoTopPadding(true);
```

#### 5. Remove Iframe Border

To remove the iframe's border, use the `setNoFrameBorder` method.

```php
NovaIframePage::make()->setNoFrameBorder(true);
```

#### 6. Set Border Radius

You can enable or disable the border radius around the iframe using the `setWithBorderRadius` method.

```php
NovaIframePage::make()->setWithBorderRadius(true);
```

#### 7. Custom Iframe Styles

You can pass an array of styles to the iframe using the `setIframeStyles` method.

```php
NovaIframePage::make()->setIframeStyles([
    'border' => '1px solid #ddd',
    'margin-top' => '20px',
]);
```

#### 8. Custom Iframe Options

Additional iframe options can be passed using the `setIframeOptions` method.

```php
NovaIframePage::make()->setIframeOptions([
    'sandbox' => 'allow-scripts allow-same-origin',
]);
```

### Example

Here's a complete example of how to configure and use the NovaIframePage tool in your Nova admin panel:

```php
use Pavloniym\NovaIframePage\NovaIframePage;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->register();

        NovaIframePage::make()
            ->setPath('/custom-page')
            ->setSrc('https://example.com')
            ->setHeight('700px')
            ->setNoScroll(true)
            ->setNoTopPadding(true)
            ->setNoFrameBorder(true)
            ->setWithBorderRadius(false)
            ->setIframeStyles([
                'border' => '2px solid #333',
                'box-shadow' => '0 0 10px rgba(0, 0, 0, 0.5)',
            ])
            ->setIframeOptions([
                'sandbox' => 'allow-forms allow-popups',
            ])
            ->register();
    }

    public function tools()
    {
        return [
            NovaIframePage::make()
                ->setName('Custom Page')
                ->setPath('/custom-page'),
        ];
    }
}
```

In this example, the iframe page is configured to display a custom page from `https://example.com` with specific styles, options, and settings.

## Conclusion

The Nova Iframe Page Tool for Laravel Nova provides a flexible way to embed external content directly within your Nova admin panel. With customizable settings and easy integration, you can enhance your admin interface by adding iframe pages tailored to your needs.

## License

This package is open-source software licensed under the [MIT license](LICENSE.md). Feel free to contribute, report issues, or suggest improvements!
