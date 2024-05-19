<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generatePagination( $data ){
        
        return "
        <style>
                /* Estilos para animar los botones de paginación */
            .pagination a {
                display: inline-block;
                padding: 0.5rem 1rem;
                margin: 0 0.25rem;
                border-radius: 0.375rem;
                background-color: #f3f4f6;
                color: #374151;
                font-weight: 500;
                transition: background-color 0.2s ease, color 0.2s ease;
            }
            .pagination a:hover {
                background-color: #3b82f6;
                color: #ffffff;
            }
            .pagination .active a {
                background-color: #3b82f6;
                color: #ffffff;
            }

            .pagination-link {
                display: inline-block;
                padding: 0.5rem 1rem;
                margin: 0 0.25rem;
                border-radius: 0.375rem;
                background-color: #f3f4f6;
                color: #374151;
                font-weight: 500;
                transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
                text-decoration: none;
            }

            .pagination-link:hover {
                background-color: #3b82f6;
                color: #ffffff;
                transform: scale(1);
            }

            .pagination-link.active {
                background-color: #3b82f6;
                color: #ffffff;
            }

            .pagination-link.disabled {
                background-color: #e5e7eb;
                color: #9ca3af;
                cursor: not-allowed;
            }
        </style>
        <nav role='navigation' aria-label='pagination' class='mx-auto flex w-full justify-center mt-6'>
            <ul class='flex flex-row items-center gap-1'>
                <!-- Previous page link -->
                <li>
                    <a href='{$data->previousPageUrl()}' class='pagination-link" . ($data->onFirstPage() ? ' disabled' : '') . "'>&laquo; Previous</a>
                </li>
                <!-- Pagination elements -->
                " . implode('', array_map(function($i) use ($data) {
                    return "
                        <li>
                            <a href='{$data->url($i)}' class='pagination-link" . ($i == $data->currentPage() ? ' active' : '') . "'>$i</a>
                        </li>";
                }, range(1, $data->lastPage()))) . "
                <!-- Next page link -->
                <li>
                    <a href='{$data->nextPageUrl()}' class='pagination-link" . ($data->hasMorePages() ? '' : ' disabled') . "'>Next &raquo;</a>
                </li>
            </ul>
        </nav>
        ";
        
    }

    public function getCurrentProtocol(){
         // Check if the HTTPS key is set and is 'on' or '1'
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] == 1)) {
            return 'https';
        }
        // If not, default to 'http'
        return 'http';
    }

    public function registerSession( $data ){
        DB::table('sessions')->insert( $data );
    }

    public function registerUser( $data ){
        DB::table('users')->insert( $data );
    }
    
}
