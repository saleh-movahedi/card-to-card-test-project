<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertNumeralsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $input = $request->all();

        // Convert Persian or Arabic numerals to English numerals
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = $this->convertNumerals($value);
            }
        }

        $request->merge($input);

        return $next($request);
    }

    private function convertNumerals($input): array|string
    {
        $persianNumerals = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabicNumerals = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

        return str_replace(
            $persianNumerals, range(0, 9),
            str_replace($arabicNumerals, range(0, 9), $input));
    }

}
