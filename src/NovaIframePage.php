<?php

namespace Pavloniym\NovaIframePage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Middleware\Authenticate;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Pavloniym\NovaIframePage\Http\Middleware\Authorize;

class NovaIframePage extends Tool
{
    // Menu
    protected string $icon = 'server';
    protected string $name = 'Iframe page';
    protected string $path = 'nova-iframe-page';

    // IFrame
    protected ?string $src = null;
    protected ?string $height = 'calc(100vh - 56px - 32px - 32px)';

    protected ?bool $noScroll = false;
    protected ?bool $noTopPadding = false;
    protected ?bool $noFrameBorder = true;
    protected ?bool $withBorderRadius = true;

    protected ?array $iframeStyles = null;
    protected ?array $iframeOptions = null;


    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-iframe-page', __DIR__ . '/../dist/js/tool.js');
    }


    /**
     * Register route
     *
     * @return void
     */
    public function register()
    {
        if (app()->routesAreCached()) {
            return;
        }

        Nova::router(['nova', Authenticate::class, Authorize::class], $this->path)->group(function () {
            Route::get('/', function (NovaRequest $request) {
                return inertia('NovaIframePage', [
                    'src' => $this->src,
                    'height' => $this->height,
                    'noScroll' => $this->noScroll,
                    'noTopPadding' => $this->noTopPadding,
                    'iframeStyles' => $this->iframeStyles,
                    'iframeOptions' => $this->iframeOptions,
                    'noFrameBorder' => $this->noFrameBorder,
                    'withBorderRadius' => $this->withBorderRadius,
                ]);
            });
        });
    }


    /**
     * Build the menu that renders the navigation links for the tool.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function menu(Request $request)
    {
        return MenuSection::make($this->name)
            ->path($this->path)
            ->icon($this->icon);
    }


    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return $this
     */
    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }


    /**
     * Set icon
     *
     * @param string $icon
     * @return $this
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }


    /**
     * Set the source URL.
     *
     * @param string|null $src
     * @return $this
     */
    public function setSrc(?string $src): self
    {
        $this->src = $src;
        return $this;
    }

    /**
     * Set the height of the component.
     *
     * @param string $height
     * @return $this
     */
    public function setHeight(string $height): self
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Set whether scrolling is disabled.
     *
     * @param bool $noScroll
     * @return $this
     */
    public function setNoScroll(bool $noScroll): self
    {
        $this->noScroll = $noScroll;
        return $this;
    }

    /**
     * Set whether top padding is disabled.
     *
     * @param bool $noTopPadding
     * @return $this
     */
    public function setNoTopPadding(bool $noTopPadding): self
    {
        $this->noTopPadding = $noTopPadding;
        return $this;
    }

    /**
     * Set the styles for the iframe.
     *
     * @param array|null $iframeStyles
     * @return $this
     */
    public function setIframeStyles(?array $iframeStyles): self
    {
        $this->iframeStyles = $iframeStyles;
        return $this;
    }

    /**
     * Set the options for the iframe.
     *
     * @param array|null $iframeOptions
     * @return $this
     */
    public function setIframeOptions(?array $iframeOptions): self
    {
        $this->iframeOptions = $iframeOptions;
        return $this;
    }

    /**
     * Set whether the iframe should have no border.
     *
     * @param bool $noFrameBorder
     * @return $this
     */
    public function setNoFrameBorder(bool $noFrameBorder): self
    {
        $this->noFrameBorder = $noFrameBorder;
        return $this;
    }

    /**
     * Set whether the component should have a border radius.
     *
     * @param bool $withBorderRadius
     * @return $this
     */
    public function setWithBorderRadius(bool $withBorderRadius): self
    {
        $this->withBorderRadius = $withBorderRadius;
        return $this;
    }
}
