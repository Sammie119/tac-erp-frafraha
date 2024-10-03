<?php

namespace App\View\Components\Datatable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Datatable extends Component
{
    public array $headers;
    /**
     * Create a new component instance.
     */
    public function __construct(array $headers)
    {
//        dd($this->formatHeader($headers));
        $this->headers = $this->formatHeader($headers);
    }

    private function formatHeader(array $headers): array
    {
//        dd($headers);
        return array_map(function ($header) {
            $name = is_array($header) ? $header['name'] : $header;

            return [
                'name' => $name,
                'width' => $header['width'] ?? null,
                'classes' => $header['classes'] ?? null,
                'nowrap' => $header['nowrap'] ?? null,
            ];
        }, $headers);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.datatable.datatable');
    }
}
