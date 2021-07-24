<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseMacroProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data, $status, $hasPage = false) {
            
            if ($hasPage) {
                $paginate = [
                    'total' => $data->total(),
                    'per_page' => $data->perPage(),
                    'current_page' => $data->currentPage(),
                    'last_page' => $data->lastPage(),
                    'next_page_url' => $data->nextPageUrl(),
                    'prev_page_url' => $data->previousPageUrl(),
                    'from' => $data->firstItem(),
                    'to' => $data->firstItem()
                ];
            }

            $successResponse = [
                'status' => $status,
                'error_msg' => null,
                'data' => $data
            ];
            
            return response()->json(array_merge($successResponse,  $paginate ?? []), $status);
        });

        Response::macro('error', function ($message, $status, $error = null) {
            $errorResponse = [
                'status' => $status,
                'description' => $message,
                'fields' => $error ? $error : '',
                'data' => null
            ];

            return response()->json($errorResponse, $status);
        });

    }
}
